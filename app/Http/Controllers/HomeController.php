<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Banner;
use App\Models\About;
use App\Models\Service;
use App\Models\News;
use App\Models\Directory;
use App\Models\Company;
use App\Mail\EmailNotification;
use Illuminate\Support\Facades\Mail;

class HomeController extends Controller
{

    
    public function index()
    {
        $banner = Banner::first();
        $about = About::with('type_about')->whereHas('type_about', function ($query) {
            $query->whereIn('name', ['Misión', 'Visión', 'Valores']);
        })
        ->get()
        ->mapWithKeys(function ($item) {
            return [$item->type_about->name => $item->content];
        });

        $services = Service::all();


        $news = News::OrderBy('created_at','DESC')->get();

        $directories = Directory::orderBy('order','ASC')->get();

        $imagesEmpresas = Company::where('type', 'Empresa')
            ->pluck('image_url')
            ->map(fn($path) => asset($path))
            ->toArray();

            $imagesProveedores = Company::where('type', 'Proveedor')
            ->pluck('image_url')
            ->map(fn($path) => asset($path))
            ->toArray();

        return view('principal.home', compact('banner', 'about', 'services', 'directories', 'imagesEmpresas', 'imagesProveedores', 'news'));
    }


    public function news($slug)
    {

        $news = News::where('slug', $slug)->first();

        return view('principal.news', compact('news'));
    }

    public function SendEmailContact(Request $request)
    {
        $request->validate([
            'name'    => 'required|string',
            'email'   => 'required|email',
            'subject' => 'required|string',
            'message' => 'required|string',
        ]);

        $datos = [
            'name' => $request->name,
            'email' => $request->email,
            'subject' => $request->subject,
            'message' => $request->message
        ];

        Mail::to('contacto@clusterminerodgo.com')->send(new EmailNotification($datos));

        alert('Se ha enviado el mensaje.');

        return response('', 204, [
            'Redirect-To' => url('/')
        ]);
    }
}
