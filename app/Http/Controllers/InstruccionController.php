<?php

namespace App\Http\Controllers;

use App\Instrucion;
use Illuminate\Http\Request;

class InstruccionController extends Controller
{
    public function index(){
        return Instrucion::all();
    }
    public function show(Instrucion $instrucion){
        return $instrucion;
    }
    public function store(Request $request){
        $instrucion =Instrucion::create($request->all());
        return response()->json($instrucion,201);
    }
    public function update(Request $request,Instrucion $instrucion){
        $instrucion->update($request->all());
        return response()->json($instrucion,200);
    }
    public function delete(Instrucion $instrucion){
        $instrucion->delete();
        return response()->json(null,204);
    }

}
