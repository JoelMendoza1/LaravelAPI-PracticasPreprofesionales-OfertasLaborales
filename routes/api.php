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

    Route::get('users/{user}/document', 'UserController@document');
    Route::get('instrucciones/{instrucion}/document','InstruccionController@document');
    Route::group(['middleware' => ['role:admin']], function () {
        Route::get('users/{user}/image', 'UserController@image');
    });

    Route::group(['middleware' => ['jwt.verify']], function() {
        Route::post('logout','UserController@logout');

        //Usuario
        Route::get('users','UserController@index');
        Route::get('aprobados','UserController@index1');
        Route::get('rechazados','UserController@index2');
        Route::get('pendientes','UserController@index3');
        Route::get('users/{user}','UserController@show');
        Route::put('users/{user}','UserController@update');
        Route::put('usersPasword/{user}','UserController@updatePasword');
        Route::delete('users/{user}','UserController@delete');
        Route::post('usersImagen/{user}','UserController@updateImgen');
        Route::get('usuarios','UserController@getAuthenticatedUser');

        //Empresa
        Route::get('users/{user}/empresas','EmpresaController@index');
        Route::get('users/{user}/empresas/{empresa}','EmpresaController@show');
        Route::post('users/{user}/empresas','EmpresaController@store');
        Route::put('empresas/{empresa}','EmpresaController@update');
        Route::delete('empresas/{empresa}','EmpresaController@delete');

        //Capacitacion
        Route::get('users/{user}/capacitacions','CapacitacionController@index');
        Route::get('capacitacions/{capacitacion}','CapacitacionController@show');
        Route::post('users/{user}/capacitacions','CapacitacionController@store');
        Route::put('capacitacions/{capacitacion}','CapacitacionController@update');
        Route::delete('capacitacions/{capacitacion}','CapacitacionController@delete');

        //Habilidad
        Route::get('users/{user}/habilidades','HabilidadController@index');
        Route::get('habilidades/{habilidad}','HabilidadController@show');
        Route::post('users/{user}/habilidades','HabilidadController@store');
        Route::put('habilidades/{habilidad}','HabilidadController@update');
        Route::delete('habilidades/{habilidad}','HabilidadController@delete');

        //Idioma
        Route::get('users/{user}/idiomas','IdiomaController@index');
        Route::get('idiomas/{idioma}','IdiomaController@show');
        Route::post('users/{user}/idiomas','IdiomaController@store');
        Route::put('idiomas/{idioma}','IdiomaController@update');
        Route::delete('idiomas/{idioma}','IdiomaController@delete');

        //Instruccion
        Route::get('users/{user}/instrucciones','InstruccionController@index');
        Route::get('instrucciones/{instrucion}','InstruccionController@show');
        Route::post('users/{user}/instrucciones','InstruccionController@store');
        Route::put('instrucciones/{instrucion}','InstruccionController@update');
        Route::delete('instrucciones/{instrucion}','InstruccionController@delete');
        Route::post('instruccionesDocument/{instrucion}','InstruccionController@updateDocument');

        //Proyecto
        Route::get('users/{user}/proyectos','ProyectoController@index');
        Route::get('proyectos/{proyecto}','ProyectoController@show');
        Route::post('users/{user}/proyectos','ProyectoController@store');
        Route::put('proyectos/{proyecto}','ProyectoController@update');
        Route::delete('proyectos/{proyecto}','ProyectoController@delete');

        //Trayectoria Laboral
        Route::get('users/{user}/trayectoriaslaborales','TrayectorialaboralController@index');
        Route::get('trayectoriaslaborales/{trayectorialaboral}','TrayectorialaboralController@show');
        Route::post('users/{user}/trayectoriaslaborales','TrayectorialaboralController@store');
        Route::put('trayectoriaslaborales/{trayectorialaboral}','TrayectorialaboralController@update');
        Route::delete('trayectoriaslaborales/{trayectorialaboral}','TrayectorialaboralController@delete');

        //Oferta
        Route::get('ofertas','OfertaController@index');
        Route::get('ofertas/{oferta}','OfertaController@show');
        Route::post('empresas/{empresa}/ofertas','OfertaController@store');
        Route::put('ofertas/{oferta}','OfertaController@update');
        Route::delete('ofertas/{oferta}','OfertaController@delete');

        Route::get('empresas/{empresa}/ofertas','OfertaController@index1');
        Route::get('empresas/{empresa}/visibles','OfertaController@index2');
        Route::get('empresas/{empresa}/ocultos','OfertaController@index3');

        //Postulacion
        Route::get('ofertas/{oferta}/postulacions','PostulacionController@index1');
        Route::get('users/{user}/postulacions','PostulacionController@index2');
        Route::get('users/{user}/postulacionsPendiente','PostulacionController@index3');
        Route::get('users/{user}/postulacionsAprobado','PostulacionController@index4');
        Route::get('users/{user}/postulacionsRechazado','PostulacionController@index5');
        Route::get('postulacions/{postulacion}','PostulacionController@show');
        Route::delete('postulacions/{postulacion}','PostulacionController@delete');
        Route::put('postulacions/{postulacion}','PostulacionController@update');

        Route::post('users/{user}/postulacion','PostulacionController@store');

    });
});




