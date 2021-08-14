<?php

use Illuminate\Http\Request;
use App\Empresa;
use App\Pasante;
use App\Solicitudaprobacion;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
Route::get('/', function () {
    return view('welcome');
});
Route::group(['middleware' => ['cors']], function () {
    Route::post('registrar','UserController@register');
    Route::post('inicioSesion','UserController@authenticate');


    Route::group(['middleware' => ['jwt.verify']], function() {

        //Empresa
        Route::get('users/{user}/empresas','EmpresaController@index');
        Route::get('users/{user}/empresas/{empresa}','EmpresaController@show');
        Route::post('users/{user}/empresas','EmpresaController@store');
        Route::put('users/{user}/empresas/{empresa}','EmpresaController@update');
        Route::delete('users/{user}/empresas/{empresa}','EmpresaController@delete');

        //Usuario
        Route::get('users','UserController@index');
        Route::get('users/{user}','UserController@show');
        Route::put('users/{user}','UserController@update');
        Route::delete('users/{user}','UserController@delete');

        Route::get('usuarios','UserController@getAuthenticatedUser');
        Route::post('logout','UserController@logout');

        //Capacitacion
        Route::get('users/{user}/capacitacions','CapacitacionController@index');
        Route::get('users/{user}/capacitacions/{capacitacion}','CapacitacionController@show');
        Route::post('users/{user}/capacitacions','CapacitacionController@store');
        Route::put('users/{user}/capacitacions/{capacitacion}','CapacitacionController@update');
        Route::delete('users/{user}/capacitacions/{capacitacion}','CapacitacionController@delete');

        //Habilidad
        Route::get('users/{user}/habilidades','HabilidadController@index');
        Route::get('users/{user}/habilidades/{habilidad}','HabilidadController@show');
        Route::post('users/{user}/habilidades','HabilidadController@store');
        Route::put('users/{user}/habilidades/{habilidad}','HabilidadController@update');
        Route::delete('users/{user}/habilidades/{habilidad}','HabilidadController@delete');

        //Idioma
        Route::get('users/{user}/idiomas','IdiomaController@index');
        Route::get('users/{user}/idiomas/{idiomas}','IdiomaController@show');
        Route::post('users/{user}/idiomas','IdiomaController@store');
        Route::put('users/{user}/idiomas/{idiomas}','IdiomaController@update');
        Route::delete('users/{user}/idiomas/{idiomas}','IdiomaController@delete');

        //Instruccion
        Route::get('users/{user}/instrucciones','InstruccionController@index');
        Route::get('users/{user}/instrucciones/{instrucion}','InstruccionController@show');
        Route::post('users/{user}/instrucciones','InstruccionController@store');
        Route::put('users/{user}/instrucciones/{instrucion}','InstrucionController@update');
        Route::delete('users/{user}/instrucciones/{instrucion}','InstruccionController@delete');

        //Proyecto
        Route::get('users/{user}/proyectos','ProyectoController@index');
        Route::get('users/{user}/proyectos/{proyecto}','ProyectoController@show');
        Route::post('users/{user}/proyectos','ProyectoController@store');
        Route::put('users/{user}/proyectos/{proyecto}','ProyectoController@update');
        Route::delete('users/{user}/proyectos/{proyecto}','ProyectoController@delete');

        //Trayectoria Laboral
        Route::get('users/{user}/trayectoriaslaborales','TrayectorialaboralController@index');
        Route::get('users/{user}/trayectoriaslaborales/{trayectorialaboral}','TrayectorialaboralController@show');
        Route::post('users/{user}/trayectoriaslaborales','TrayectorialaboralController@store');
        Route::put('users/{user}/trayectoriaslaborales/{trayectorialaboral}','TrayectorialaboralController@update');
        Route::delete('users/{user}/trayectoriaslaborales/{trayectorialaboral}','TrayectorialaboralController@delete');

        //Oferta
        Route::get('ofertas','OfertaController@index');
        Route::get('ofertas/{oferta}','OfertaController@show');
        Route::post('ofertas','OfertaController@store');
        Route::put('ofertas/{oferta}','OfertaController@update');
        Route::delete('ofertas/{oferta}','OfertaController@delete');

    });
});




