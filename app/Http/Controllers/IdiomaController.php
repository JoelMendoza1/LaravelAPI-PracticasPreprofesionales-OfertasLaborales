<?php

namespace App\Http\Controllers;

use App\Idioma;
use Illuminate\Http\Request;

class IdiomaController extends Controller
{
    public function index(){
        return Idioma::all();
    }
    public function show(Idioma $idioma){
        return $idioma;
    }
    public function store(Request $request){
        $idioma =Idioma::create($request->all());
        return response()->json($idioma,201);
    }
    public function update(Request $request,Idioma $idioma){
        $idioma->update($request->all());
        return response()->json($idioma,200);
    }
    public function delete(Idioma $idioma){
        $idioma->delete();
        return response()->json(null,204);
    }

}
