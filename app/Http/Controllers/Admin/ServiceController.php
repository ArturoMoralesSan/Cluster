<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Service;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\ServiceRequest;

class ServiceController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('view.services') || Gate::allows('create.services'), 403);
        $services = Service::all();
        return view('admin.servicios.index', compact('services'));   
    }

    public function save(ServiceRequest $request)
    {
        abort_unless(Gate::allows('view.services') || Gate::allows('edit.services'), 403);
        
        $service = new Service;
        $service->name = $request->title;
        $service->description = $request->description;

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->move(public_path('img/services'), $fileName);
            $service->image_url = 'img/services/' . $fileName;
        }

        $service->save();

        alert('Se ha agregado un elemento a servicios.');

        return response('', 204, [
            'Redirect-To' => url('admin/servicios/')
        ]);
    }

    public function edit($id)
    {
        abort_unless(Gate::allows('view.services') || Gate::allows('edit.services'), 403);
        $service = Service::find($id);
        return view('admin.servicios.editar', compact('service'));
    }


    public function update(ServiceRequest $request, $id)
    {
        abort_unless(Gate::allows('view.about') || Gate::allows('edit.about'), 403);

        $service = Service::find($id);
        $service->name = $request->title;
        $service->description = $request->description;

        if ($request->hasFile('cover')) {

            if ($service->image_url && file_exists(public_path($service->image_url))) {
                unlink(public_path($service->image_url));
            }
            
            $file = $request->file('cover');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $filePath = $file->move(public_path('img/services'), $fileName);
            $service->image_url = 'img/services/' . $fileName;
        }

        $service->save();

        alert('Se ha actualizado un elemento de servicios.');

        return response('', 204, [
            'Redirect-To' => url('admin/servicios/')
        ]);
    }

    public function delete($id)
    {
        abort_unless(Gate::allows('view.services') || Gate::allows('create.services'), 403);

        $service = Service::find($id);
        $service->delete();

        return response('', 204);

    }
}
