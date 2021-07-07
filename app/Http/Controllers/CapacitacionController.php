<?php

namespace App\Http\Controllers;

use App\Capacitacion;
use App\Pasante;
use Illuminate\Http\Request;
use App\Http\Resources\Capacitacion as CapacitacionResource;

class CapacitacionController extends Controller
{
    public function index(Pasante $pasante){

        return response()->json(CapacitacionResource::collection($pasante->capacitacion),200);
    }
    public function show(Pasante $pasante, Capacitacion $capacitacion){
        return response()->json($pasante->capacitacion()->where('id',$capacitacion->id)->firstOrFail(),200);
    }
    public function store(Request $request, Pasante $pasante){
        $request->validate([
            'nombreCapacitacion'=>'required|string|max:255',
            'nombreInstitucionCapacitadora'=> 'required|string',
            'fechaInicioCapacitacion'=>'required|string',
            'fechaFinCapacitacion'=>'required|string',
        ]);
        $capacitacion =$pasante->capacitacion()->save(new Capacitacion($request->all()));
        return response()->json($capacitacion,201);
    }
    public function update(Request $request,Capacitacion $capacitacion){
        $capacitacion->update($request->all());
        return response()->json($capacitacion,200);
    }
    public function delete(Capacitacion $capacitacion){
        $capacitacion->delete();
        return response()->json(null,204);
    }

}
