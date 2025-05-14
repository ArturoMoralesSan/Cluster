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
        
        $directory = new Directory;
        $directory->name = $request->name;
        $directory->position = $request->position;
        $directory->email = $request->email;

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
