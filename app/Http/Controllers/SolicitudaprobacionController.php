<?php

namespace App\Http\Controllers;

use App\Empresa;
use App\Solicitudaprobacion;
use App\Pasante;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Http\Resources\Solicitudaprobacion as SolicitudaprobacionResource;
use App\Http\Resources\SolicitudaprobacionCollection;
class SolicitudaprobacionController extends Controller
{
    public function index(){
        return new SolicitudaprobacionCollection( Solicitudaprobacion::paginate(20));
    }
    public function show(Solicitudaprobacion $solicitudaprobacion){
        return response()->json(new SolicitudaprobacionResource($solicitudaprobacion),200);
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'tipo' => 'required',
            ]);
        $solicitudaprobacion= Solicitudaprobacion::create($validatedData);
        return response()->json($solicitudaprobacion,201);
    }

    public function storePasante(Request $request, Pasante $pasante){
        $request->validate([
            'tipo' => 'required',
        ]);
        $solicitudaprobacion =$pasante->solicitudAprobacion()->save(new Solicitudaprobacion($request->all()));
        return response()->json($solicitudaprobacion,201);
    }
    public function storeEmpresa(Request $request, Empresa $empresa){
        $request->validate([
            'tipo' => 'required',
        ]);
        $solicitudaprobacion =$empresa->capacitacion()->save(new Solicitudaprobacion($request->all()));
        return response()->json($solicitudaprobacion,201);
    }

    public function update(Request $request, Solicitudaprobacion $solicitudaprobacion){
        $validatedData = $request->validate([
            'estadoSolicitud'=>'required',
            'descripcion' => 'required|string|max:255',
            'user_id'=> 'required'
            ]);
        $solicitudaprobacion->update($validatedData);
        $solicitudaprobacion->user_id = Auth::id();
        return response()->json($solicitudaprobacion,200);
    }
    public function delete(Solicitudaprobacion $solicitudaprobacion){
        $solicitudaprobacion->delete();
        return response()->json(null,204);
    }
}
