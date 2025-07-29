<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Directory;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\DirectoryRequest;
use Illuminate\Support\Str;

class DirectoryController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('view.directories') || Gate::allows('create.directories'), 403);
        $directories = Directory::all();
        return view('admin.directorio.index', compact('directories'));   
    }

    public function save(DirectoryRequest $request)
    {
        abort_unless(Gate::allows('view.directories') || Gate::allows('edit.directories'), 403);

        $lastOrder = Directory::max('order') ?? 0;
        
        $directory = new Directory;
        $directory->name = $request->name;
        $directory->position = $request->position;
        $directory->email = $request->email;
        $directory->order = $lastOrder + 1;

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = base_path('../public_html/img/directorio');
            $filePath = $file->move($destinationPath, $fileName);
            $directory->image_url = 'img/directorio/' . $fileName;
        }

        $directory->save();

        alert('Se ha agregado un elemento al directorio.');

        return response('', 204, [
            'Redirect-To' => url('admin/directorio/')
        ]);
    }

    public function edit($id)
    {
        abort_unless(Gate::allows('view.directories') || Gate::allows('edit.directories'), 403);
        $directory = Directory::find($id);

        return view('admin.directorio.editar', compact('directory'));
    }


    public function update(DirectoryRequest $request, $id)
    {
        abort_unless(Gate::allows('view.directories') || Gate::allows('edit.directories'), 403);

        $directory = Directory::find($id);
        $directory->name = $request->name;
        $directory->position = $request->position;
        $directory->email = $request->email;
        if ($request->hasFile('cover')) {
            $oldImagePath = base_path('../public_html/' . $directory->image_url);

            if ($directory->image_url && file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            $file = $request->file('cover');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = base_path('../public_html/img/directorio');
            $file->move($destinationPath, $fileName);
            $directory->image_url = 'img/directorio/' . $fileName;
        }

        $directory->save();

        alert('Se ha actualizado un elemento del directorio.');

        return response('', 204, [
            'Redirect-To' => url('admin/directorio/')
        ]);
    }

    public function delete($id)
    {
        abort_unless(Gate::allows('view.directories') || Gate::allows('create.directories'), 403);

        $directories = Directory::find($id);
        $directories->delete();

        return response('', 204);

    }
}
