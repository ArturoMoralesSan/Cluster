<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\News;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\NewsRequest;
use Illuminate\Support\Str;


class NewsController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('view.services') || Gate::allows('create.services'), 403);
        $news = News::all();
        return view('admin.noticias.index', compact('news'));   
    }

    public function save(NewsRequest $request)
    {
        abort_unless(Gate::allows('view.services') || Gate::allows('edit.services'), 403);
        
        $news = new News;
        $news->title = $request->title;
        $news->description = $request->description;
        $news->slug = Str::slug($request->title);

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $fileName = time() . '_' . $file->getClientOriginalName();

            $destinationPath = base_path('../public_html/img/noticias');

            $filePath = $file->move($destinationPath, $fileName);

            $news->image_url = 'img/noticias/' . $fileName;
        }

        $news->save();

        alert('Se ha agregado una noticia.');

        return response('', 204, [
            'Redirect-To' => url('admin/noticias/')
        ]);
    }

    public function edit($id)
    {
        abort_unless(Gate::allows('view.services') || Gate::allows('edit.services'), 403);
        $news = News::find($id);
        return view('admin.noticias.editar', compact('news'));
    }


    public function update(NewsRequest $request, $id)
    {
        abort_unless(Gate::allows('view.about') || Gate::allows('edit.about'), 403);

        $news = News::find($id);
        $news->title = $request->title;
        $news->description = $request->description;
        $news->slug = Str::slug($request->title);

        if ($request->hasFile('cover')) {
            $oldImagePath = base_path('../public_html/' . $news->image_url);

            if ($news->image_url && file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            $file = $request->file('cover');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = base_path('../public_html/img/noticias');

            $file->move($destinationPath, $fileName);

            $news->image_url = 'img/noticias/' . $fileName;
        }


        $news->save();

        alert('Se ha actualizado una noticia.');

        return response('', 204, [
            'Redirect-To' => url('admin/noticias/')
        ]);
    }

    public function delete($id)
    {
        abort_unless(Gate::allows('view.services') || Gate::allows('create.services'), 403);

        $news = News::find($id);
        $news->delete();

        return response('', 204);

    }
}
