<?php

namespace App\Http\Controllers;

use App\Trayectorialaboral;
use Illuminate\Http\Request;

class TrayectorialaboralController extends Controller
{
    public function index(){
        return Trayectorialaboral::all();
    }
    public function show(Trayectorialaboral $trayectorialaboral){
        return $trayectorialaboral;
    }
    public function store(Request $request){
        $trayectorialaboral =Trayectorialaboral::create($request->all());
        return response()->json($trayectorialaboral,201);
    }
    public function update(Request $request,Trayectorialaboral $trayectorialaboral){
        $trayectorialaboral->update($request->all());
        return response()->json($trayectorialaboral,200);
    }
    public function delete(Trayectorialaboral $trayectorialaboral){
        $trayectorialaboral->delete();
        return response()->json(null,204);
    }

}
