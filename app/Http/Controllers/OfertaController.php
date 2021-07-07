<?php

namespace App\Http\Controllers;

use App\Oferta;
use Illuminate\Http\Request;

class OfertaController extends Controller
{
    public function index(){
        return Oferta::all();
    }
    public function show(Oferta $oferta){
        return $oferta;
    }
    public function store(Request $request){
        $oferta =Oferta::create($request->all());
        return response()->json($oferta,201);
    }
    public function update(Request $request,Oferta $oferta){
        $oferta->update($request->all());
        return response()->json($oferta,200);
    }
    public function delete(Oferta $oferta){
        $oferta->delete();
        return response()->json(null,204);
    }

}
