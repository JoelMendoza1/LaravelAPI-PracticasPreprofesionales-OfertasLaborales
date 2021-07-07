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

    Route::post('registrarPasante','PasanteController@register');
    Route::post('inicioSesionPasante','PasanteController@authenticate');

    Route::post('registrarEmpresa','EmpresaController@register');
    Route::post('inicioSesionEmpresa','EmpresaController@authenticate');


    Route::group(['middleware' => ['jwt.verify']], function() {

        //Empresa
        Route::get('empresas','EmpresaController@index');
        Route::get('empresas/{empresa}','EmpresaController@show');
        Route::post('empresas','EmpresaController@store');
        Route::put('empresas/{empresa}','EmpresaController@update');
        Route::delete('empresas/{empresa}','EmpresaController@delete');
        Route::get('empresa','EmpresaController@getAuthenticatedEmpresa');

        //Pasantes
        Route::get('pasantes','PasanteController@index');
        Route::get('pasantes/{pasante}','PasanteController@show');
        Route::post('pasantes','PasanteController@store');
        Route::put('pasantes/{pasante}','PasanteController@update');
        Route::delete('pasantes/{pasante}','PasanteController@delete');
        Route::get('pasante','PasanteController@getAuthenticatedPasante');

        //Solicitus de Aprobacion
        Route::get('solicitudaprobacions','SolicitudaprobacionController@index');
        Route::get('solicitudaprobacions/{solicitudaprobacion}','SolicitudaprobacionController@show');
        Route::post('solicitudaprobacions','SolicitudaprobacionController@store');
        Route::put('solicitudaprobacions/{solicitudaprobacion}','SolicitudaprobacionController@update');
        Route::delete('solicitudaprobacions/{solicitudaprobacion}','SolicitudaprobacionController@delete');
        Route::post('pasantes/{pasante}/solicitudaprobacions','SolicitudaprobacionController@storePasante');
        Route::post('empresas/{empresa}/solicitudaprobacions','SolicitudaprobacionController@storeEmpresa');

        //Usuario
        Route::get('usuarios','UserController@getAuthenticatedUser');
        Route::post('logout','UserController@logout');

        //Capacitacion
        Route::get('pasantes/{pasante}/capacitaciones','CapacitacionController@index');
        Route::get('pasantes/{pasante}/capacitaciones/{capacitacion}','CapacitacionController@show');
        Route::post('pasantes/{pasante}/capacitaciones','CapacitacionController@store');
        Route::put('pasantes/{pasante}/capacitaciones/{capacitacion}','CapacitacionController@update');
        Route::delete('pasantes/{pasante}/capacitaciones/{capacitacion}','CapacitacionController@delete');

        //Habilidad
        Route::get('pasantes/{pasante}/habilidades','HabilidadController@index');
        Route::get('pasantes/{pasante}/habilidades/{habilidad}','HabilidadController@show');
        Route::post('pasantes/{pasante}/habilidades','HabilidadController@store');
        Route::put('pasantes/{pasante}/habilidades/{habilidad}','HabilidadController@update');
        Route::delete('pasantes/{pasante}/habilidades/{habilidad}','HabilidadController@delete');

        //Idioma
        Route::get('pasantes/{pasante}/idiomas','IdiomaController@index');
        Route::get('pasantes/{pasante}/idiomas/{idiomas}','IdiomaController@show');
        Route::post('pasantes/{pasante}/idiomas','IdiomaController@store');
        Route::put('pasantes/{pasante}/idiomas/{idiomas}','IdiomaController@update');
        Route::delete('pasantes/{pasante}/idiomas/{idiomas}','IdiomaController@delete');

        //Instruccion
        Route::get('pasantes/{pasante}/instrucciones','InstruccionController@index');
        Route::get('pasantes/{pasante}/instrucciones/{instrucion}','InstruccionController@show');
        Route::post('pasantes/{pasante}/instrucciones','InstruccionController@store');
        Route::put('pasantes/{pasante}/instrucciones/{instrucion}','InstrucionController@update');
        Route::delete('pasantes/{pasante}/instrucciones/{instrucion}','InstruccionController@delete');

        //Proyecto
        Route::get('pasantes/{pasante}/proyectos','ProyectoController@index');
        Route::get('pasantes/{pasante}/proyectos/{proyecto}','ProyectoController@show');
        Route::post('pasantes/{pasante}/proyectos','ProyectoController@store');
        Route::put('pasantes/{pasante}/proyectos/{proyecto}','ProyectoController@update');
        Route::delete('pasantes/{pasante}/proyectos/{proyecto}','ProyectoController@delete');

        //Trayectoria Laboral
        Route::get('pasantes/{pasante}/trayectoriaslaborales','TrayectorialaboralController@index');
        Route::get('pasantes/{pasante}/trayectoriaslaborales/{trayectorialaboral}','TrayectorialaboralController@show');
        Route::post('pasantes/{pasante}/trayectoriaslaborales','TrayectorialaboralController@store');
        Route::put('pasantes/{pasante}/trayectoriaslaborales/{trayectorialaboral}','TrayectorialaboralController@update');
        Route::delete('pasantes/{pasante}/trayectoriaslaborales/{trayectorialaboral}','TrayectorialaboralController@delete');

        //Oferta
        Route::get('ofertas','OfertaController@index');
        Route::get('ofertas/{oferta}','OfertaController@show');
        Route::post('ofertas','OfertaController@store');
        Route::put('ofertas/{oferta}','OfertaController@update');
        Route::delete('ofertas/{oferta}','OfertaController@delete');

    });
});




