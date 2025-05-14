<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\BannerRequest;

class BannerController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('view.banners') || Gate::allows('create.banners'), 403);
        $banners = Banner::all();
        return view('admin.banners.index', compact('banners'));   
    }

    public function save(BannerRequest $request)
    {
        abort_unless(Gate::allows('view.banners') || Gate::allows('edit.banners'), 403);
        
        $banner = new Banner;
        $banner->title = $request->title;
        $banner->link = $request->link;
        $banner->description = $request->description;

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->move(public_path('img/banners'), $fileName);
            $banner->image_url = 'img/banners/' . $fileName;
        }

        $banner->save();

        alert('Se ha agregado un banner.');

        return response('', 204, [
            'Redirect-To' => url('admin/banners/')
        ]);
    }

    public function edit($id)
    {
        abort_unless(Gate::allows('view.banners') || Gate::allows('edit.banners'), 403);
        $banner = Banner::find($id);
        return view('admin.banners.editar', compact('banner'));
    }


    public function update(BannerRequest $request, $id)
    {
        abort_unless(Gate::allows('view.banners') || Gate::allows('edit.banners'), 403);
        
        $banner = Banner::find($id);
        $banner->title = $request->title;
        $banner->link = $request->link;
        $banner->description = $request->description;

        if ($request->hasFile('cover')) {

            if ($banner->image_url && file_exists(public_path($banner->image_url))) {
                unlink(public_path($banner->image_url));
            }
            
            $file = $request->file('cover');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->move(public_path('img/banners'), $fileName);
            $banner->image_url = 'img/banners/' . $fileName;
        }

        $banner->save();

        alert('Se ha actualizado un banner.');

        return response('', 204, [
            'Redirect-To' => url('admin/banners/')
        ]);
    }

    public function delete($id)
    {
        abort_unless(Gate::allows('view.banners') || Gate::allows('create.banners'), 403);

        $banners = Banner::find($id);
        $banners->delete();

        return response('', 204);

    }
}
