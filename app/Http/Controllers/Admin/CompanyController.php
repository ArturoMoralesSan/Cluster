<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\Support\Facades\Gate;
use App\Http\Requests\CompanyRequest;

class CompanyController extends Controller
{
    public function index()
    {
        abort_unless(Gate::allows('view.about') || Gate::allows('create.about'), 403);
        $companies = Company::all();
        return view('admin.empresas.index', compact('companies'));   
    }

    public function save(CompanyRequest $request)
    {
        abort_unless(Gate::allows('view.about') || Gate::allows('edit.about'), 403);
        
        $company = new Company;
        $company->name = $request->name;
        $company->type = $request->type;

        if ($request->hasFile('cover')) {
            $file = $request->file('cover');
            $fileName = time() . '_' . $file->getClientOriginalName();

            $destinationPath = base_path('../public_html/img/companies');

            $filePath = $file->move($destinationPath, $fileName);

            $company->image_url = 'img/companies/' . $fileName;
        }


        $company->save();

        alert('Se ha agregado una empresa.');

        return response('', 204, [
            'Redirect-To' => url('admin/empresas/')
        ]);
    }

    public function edit($id)
    {
        abort_unless(Gate::allows('view.about') || Gate::allows('edit.about'), 403);
        $company = Company::find($id);
        return view('admin.empresas.editar', compact('company'));
    }


    public function update(CompanyRequest $request, $id)
    {
        abort_unless(Gate::allows('view.banners') || Gate::allows('edit.banners'), 403);
        
        $company = Company::find($id);
        $company->name = $request->name;
        $company->type = $request->type;

        if ($request->hasFile('cover')) {
            $oldImagePath = base_path('../public_html/' . $company->image_url);

            if ($company->image_url && file_exists($oldImagePath)) {
                unlink($oldImagePath);
            }

            $file = $request->file('cover');
            $fileName = time() . '_' . $file->getClientOriginalName();
            $destinationPath = base_path('../public_html/img/companies');

            $file->move($destinationPath, $fileName);

            $company->image_url = 'img/companies/' . $fileName;
        }

        $company->save();

    
        alert('Se ha actualizado una empresa.');

        return response('', 204, [
            'Redirect-To' => url('admin/empresas/')
        ]);
    }

    public function delete($id)
    {
        abort_unless(Gate::allows('view.company') || Gate::allows('create.company'), 403);

        $company = Company::find($id);
        $company->delete();

        return response('', 204);

    }
}
