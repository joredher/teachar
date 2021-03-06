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


//DB::listen(function ($query){
//   var_dump($query->sql);
//}); Consultas de BD

Auth::routes();

//Route::get('/home', 'HomeController@index')->name('home');
//Route::get('/admin-home', 'HomeController@index')->middleware('AuthAdmin');
//Route::get('/home', 'HomeController@index')->middleware('AuthAdmin');
Route::get('/', 'HomeController@index')->name('main');
Route::get('/show', 'HomeController@show');

Route::group(['middleware' => ['AuthAdmin']], function (){
    Route::prefix('administracion/configuracion')
        ->namespace('Administrador\Configuracion')
        ->group(function (){
            Route::get('home', 'AdministradorController@index')->name('/');

            Route::get('docentes','DocentesController@index')->name('docentes');
            Route::post('obtener-docentes','DocentesController@obtener');
            Route::post('guardar-docente','DocentesController@guardarDocente');
            Route::delete('eliminar-docente', 'DocentesController@destroy');

            // modulos
            Route::get('modulos','ModulosController@index')->name('modulos');
            Route::post('obtener-modulos', 'ModulosController@obtener');
            Route::post('guardar-modulo', 'ModulosController@guardar');
            Route::delete('eliminar-modulo', 'ModulosController@destroy');

            // temas
            Route::get('temas','TemasController@index')->name('temas');
            Route::post('obtener-temas', 'TemasController@obtenerTemas');
            Route::get('obtener-complemento', 'TemasController@obtenerComplemento');
            Route::post('guardar-tema', 'TemasController@guardar');
            Route::delete('eliminar-tema', 'TemasController@destroy');

            // Objetos
            Route::get('objetos', 'ObjetosController@index')->name('objetos');
            Route::post('obtener-objeto', 'ObjetosController@obtenerObjetos');
            Route::get('obtener-complemento-objeto', 'ObjetosController@obtenerComplemento');
            Route::post('guardar-objeto', 'ObjetosController@guardar');
            Route::delete('eliminar-objeto', 'ObjetosController@destroy');
//            Route::post('guardar-objeto', 'ObjetosController@store');

        });

});

Route::group(['middleware' => ['AuthUser']], function (){
    Route::prefix('usuario')
        ->namespace('Usuario')
        ->group(function (){
            Route::get('index', 'UsuarioController@index')->name('index');
            Route::get('modulos-usuario','ModuloUsuarioController@show')->name('modulos-usuario');
            Route::get('modulo/{slug}', ['middleware' => 'temaModulo', 'uses' => 'TemaUsuarioController@show'])->name('temas-usuario');
            Route::get('modulo/tema/{slug}' , ['middleware' => 'temaModulo', 'uses' => 'AumentadaUsuarioController@show']);
//          Route::post('helpers/form-step', 'StepController@guardar');
            Route::post('form-step', 'StepController@guardar');
        });
});