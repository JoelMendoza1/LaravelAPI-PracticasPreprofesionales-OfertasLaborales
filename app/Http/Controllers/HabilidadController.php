<?php

namespace App\Http\Controllers;

use App\Habilidad;
use Illuminate\Http\Request;

class HabilidadController extends Controller
{
    public function index(){
        return Habilidad::all();
    }
    public function show(Habilidad $habilidad){
        return $habilidad;
    }
    public function store(Request $request){
        $habilidad =Habilidad::create($request->all());
        return response()->json($habilidad,201);
    }
    public function update(Request $request,Habilidad $habilidad){
        $habilidad->update($request->all());
        return response()->json($habilidad,200);
    }
    public function delete(Habilidad $pasante){
        $pasante->delete();
        return response()->json(null,204);
    }

}
