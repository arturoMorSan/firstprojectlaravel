<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;

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
Route::get('/', 'HomeController@index')->name('home');

Route::get('iniciar-sesion', ['as' => 'login', 'uses' => 'Auth\LoginController@showLoginForm']);
Route::post('iniciar-sesion', 'Auth\LoginController@login');
Route::get('cerrar-sesion', 'Auth\LoginController@logout')->name('logout');

Route::group(['prefix' => 'admin', 'middleware' => ['auth', 'noCache']], function() {
    Route::view('/', 'admin/dashboard');
    
    //Profile
   Route::view('perfil/editar', 'admin.editar-perfil');
    Route::post('perfil/editar', 'Admin\ProfileController@update');

    //Password
    Route::view('perfil/cambiar-contrasena', 'admin.cambiar-contrasena');
    Route::post('perfil/cambiar-contrasena', 'Auth\PasswordController@update');

});
