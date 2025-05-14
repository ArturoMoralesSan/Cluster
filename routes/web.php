<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Admin\ProfileController;
use App\Http\Controllers\Admin\PermissionController;
use App\Http\Controllers\Admin\RoleController;
use App\Http\Controllers\Admin\UserController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\Admin\DirectoryController;
use App\Http\Controllers\Admin\AboutController;
use App\Http\Controllers\Admin\ServiceController;
use App\Http\Controllers\Admin\BannerController;
use App\Http\Controllers\Admin\CompanyController;
use App\Http\Controllers\Admin\NewsController;
use App\Http\Controllers\HomeController;
use Illuminate\Support\Facades\Auth;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', [HomeController::class, 'index']);
Auth::routes();
Route::get('login/{provider}', [LoginController::class, 'redirectToProvider']);
Route::get('{provider}/callback', [LoginController::class,'handleProviderCallback']);
Route::post('contacto', [HomeController::class, 'SendEmailContact']);

Route::get('noticia/{slug}', [HomeController::class,'news']);


Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'noCache']], function() {
    Route::get('/', [DashboardController::class, 'index']);

    //perfil
    Route::view('perfil/editar','admin.editar-perfil');
    Route::put('perfil/editar', [ProfileController::class, 'update']);

    //Password
    Route::view('perfil/cambiar-contrasena', 'admin.cambiar-contrasena');
    Route::post('perfil/cambiar-contrasena', [PasswordController::class, 'update']);

    // usuarios
    Route::get('usuarios', [UserController::class, 'index']);
    Route::get('agregar-usuario', [UserController::class, 'create']);
    Route::post('usuarios/crear', [UserController::class, 'save']);
    Route::get('usuarios/{id}/editar',[UserController::class, 'edit']);
    Route::put('usuarios/{id}/actualizar',[UserController::class, 'update']);
    Route::delete('usuarios/eliminar/{id}',[UserController::class, 'destroy']);

    //permisos
    Route::get('permisos', [PermissionController::class, 'index']);
    Route::view('agregar-permisos', 'admin.permisos.crear');
    Route::post('permiso/crear', [PermissionController::class, 'save']);
    Route::get('permiso/{id}/editar', [PermissionController::class, 'edit']);
    Route::put('permiso/{id}/actualizar', [PermissionController::class, 'update']);
    Route::delete('permiso/eliminar/{id}', [PermissionController::class, 'delete']);

    //roles
    Route::get('roles', [RoleController::class, 'index']);
    Route::get('agregar-roles', [RoleController::class, 'create']);
    Route::post('roles/crear', [RoleController::class, 'save']);
    Route::get('roles/{id}/editar', [RoleController::class, 'edit']);
    Route::put('roles/{id}/actualizar', [RoleController::class, 'update']);
    Route::delete('roles/eliminar/{id}', [RoleController::class, 'delete']);

    //Usuarios
    Route::get('usuarios', [UserController::class, 'index']);

    //Password
    Route::view('cambiar-contrasena', 'principal.cambiar-contrasena');
    Route::post('cambiar-contrasena', 'Auth\PasswordController@update');


    //Directorio
    Route::get('directorio', [DirectoryController::class, 'index']);
    Route::view('agregar-directorio', 'admin.directorio.crear');
    Route::post('directorio/crear', [DirectoryController::class, 'save']);
    Route::get('directorio/{id}/editar', [DirectoryController::class, 'edit']);
    Route::put('directorio/{id}/actualizar', [DirectoryController::class, 'update']);
    Route::delete('directorio/eliminar/{id}', [DirectoryController::class, 'delete']);


    //Acerca
    Route::get('acerca', [AboutController::class, 'index']);
    Route::get('agregar-acerca', [AboutController::class, 'create']);
    Route::post('acerca/crear', [AboutController::class, 'save']);
    Route::get('acerca/{id}/editar', [AboutController::class, 'edit']);
    Route::put('acerca/{id}/actualizar', [AboutController::class, 'update']);
    Route::delete('acerca/eliminar/{id}', [AboutController::class, 'delete']);

    //Servicios
    Route::get('servicios', [ServiceController::class, 'index']);
    Route::view('agregar-servicios', 'admin.servicios.crear');
    Route::post('servicios/crear', [ServiceController::class, 'save']);
    Route::get('servicios/{id}/editar', [ServiceController::class, 'edit']);
    Route::put('servicios/{id}/actualizar', [ServiceController::class, 'update']);
    Route::delete('servicios/eliminar/{id}', [ServiceController::class, 'delete']);

    //Noticias
    Route::get('noticias', [NewsController::class, 'index']);
    Route::view('agregar-noticia', 'admin.noticias.crear');
    Route::post('noticias/crear', [NewsController::class, 'save']);
    Route::get('noticias/{id}/editar', [NewsController::class, 'edit']);
    Route::put('noticias/{id}/actualizar', [NewsController::class, 'update']);
    Route::delete('noticias/eliminar/{id}', [NewsController::class, 'delete']);

    //Banners
    Route::get('banners', [BannerController::class, 'index']);
    Route::view('agregar-banner', 'admin.banners.crear');
    Route::post('banners/crear', [BannerController::class, 'save']);
    Route::get('banners/{id}/editar', [BannerController::class, 'edit']);
    Route::put('banners/{id}/actualizar', [BannerController::class, 'update']);
    Route::delete('banners/eliminar/{id}', [BannerController::class, 'delete']);

    //Empresas y provedores
    Route::get('empresas', [CompanyController::class, 'index']);
    Route::view('agregar-empresa', 'admin.empresas.crear');
    Route::post('empresas/crear', [CompanyController::class, 'save']);
    Route::get('empresas/{id}/editar', [CompanyController::class, 'edit']);
    Route::put('empresas/{id}/actualizar', [CompanyController::class, 'update']);
    Route::delete('empresas/eliminar/{id}', [CompanyController::class, 'delete']);


});