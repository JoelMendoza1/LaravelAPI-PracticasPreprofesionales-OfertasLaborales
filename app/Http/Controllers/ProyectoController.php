<?php

namespace App\Http\Controllers;

use App\Proyecto;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    public function index(){
        return Proyecto::all();
    }
    public function show(Proyecto $proyecto){
        return $proyecto;
    }
    public function store(Request $request){
        $proyecto =Proyecto::create($request->all());
        return response()->json($proyecto,201);
    }
    public function update(Request $request,Proyecto $proyecto){
        $proyecto->update($request->all());
        return response()->json($proyecto,200);
    }
    public function delete(Proyecto $proyecto){
        $proyecto->delete();
        return response()->json(null,204);
    }

}
