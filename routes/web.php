<?php

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

//Route::get('/', function () {
//    return view('welcome');
//});

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/admin-home', 'HomeController@index')->middleware('AuthAdmin');
Route::get('/show', 'HomeController@show');
Route::get('/', 'HomeController@index')->name('main');

Route::group(['middleware' => 'auth'], function (){
    Route::prefix('administracion/configuracion')
        ->namespace('Administrador\Configuracion')
        ->group(function (){
            Route::get('/', 'AdministradorController@index')->name('/');

            Route::get('docentes','RegistroDocentesController@vIndex')->name('docentes');
            Route::post('obtener-docentes','RegistroDocentesController@obtenerDocente');


            Route::get('modulos','ModulosController@index')->name('modulos');
            Route::post('obtener-modulos', 'ModulosController@obtener');
            Route::post('guardar', 'ModulosController@guardar');

        });

});
//Route::get('/home', 'HomeController@index')->middleware('AuthAdmin');
