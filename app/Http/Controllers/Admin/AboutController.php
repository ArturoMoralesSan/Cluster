<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\About;
use App\Models\type_about;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\AboutRequest;

class AboutController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('view.about') || Gate::allows('create.about'), 403);
        $abouts = About::with('type_about')->get();
        return view('admin.acerca.index', compact('abouts'));   
    }

    public function create()
    {
        abort_unless(Gate::allows('view.about') || Gate::allows('create.about'), 403);
        $types = type_about::pluck('name', 'id');
        return view('admin.acerca.crear', compact('types'));   
    }

    public function save(AboutRequest $request)
    {
        abort_unless(Gate::allows('view.about') || Gate::allows('edit.about'), 403);
        
        $about = new About;
        $about->title = $request->title;
        $about->type_about_id = $request->type;
        $about->content = $request->description;
        $about->save();

        alert('Se ha agregado un elemento en acerca.');

        return response('', 204, [
            'Redirect-To' => url('admin/acerca/')
        ]);
    }

    public function edit($id)
    {
        abort_unless(Gate::allows('view.about') || Gate::allows('edit.about'), 403);
        $about = About::find($id);
        $types = type_about::pluck('name', 'id');
        return view('admin.acerca.editar', compact('about', 'types'));
    }


    public function update(AboutRequest $request, $id)
    {
        abort_unless(Gate::allows('view.about') || Gate::allows('edit.about'), 403);

        $about = About::find($id);
        $about->title = $request->title;
        $about->type_about_id = $request->type;
        $about->content = $request->description;
        $about->save();

        alert('Se ha actualizado un elemento de acerca.');

        return response('', 204, [
            'Redirect-To' => url('admin/acerca/')
        ]);
    }

    public function delete($id)
    {
        abort_unless(Gate::allows('view.about') || Gate::allows('create.about'), 403);

        $about = About::find($id);
        $about->delete();

        return response('', 204);

    }
}
