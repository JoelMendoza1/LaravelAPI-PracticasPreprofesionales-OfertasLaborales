<?php

namespace App\Http\Controllers;

use App\Capacitacion;
use Illuminate\Http\Request;
use App\Http\Resources\Capacitacion as CapacitacionResource;
use App\User;

class CapacitacionController extends Controller
{
    private static $messages=[
        'required'=>'El campo o atributo es obligatorio',
        //'body,required'=>'El body no es valido'
    ];
    public function index(User $user){

        return response()->json(CapacitacionResource::collection($user->capacitacion),200);
    }
    public function show(User $user, Capacitacion $capacitacion){
        return response()->json($user->capacitacion()->where('id',$capacitacion->id)->firstOrFail(),200);
    }
    public function store(Request $request, User $user){
        $request->validate([
            'nombreCapacitacion'=>'required|string|max:255',
            'nombreInstitucionCapacitadora'=> 'required|string',
            'fechaInicioCapacitacion'=>'required|string',
            'fechaFinCapacitacion'=>'required|string',
            'user_id'=>'required|exists:users,id'
        ], self::$messages);
        $capacitacion =$user->capacitacion()->save(new Capacitacion($request->all()));
        return response()->json($capacitacion,201);
    }
    public function update(Request $request,Capacitacion $capacitacion, User $user){
        $request->validate([
            'nombreCapacitacion'=>'required|string|max:255',
            'nombreInstitucionCapacitadora'=> 'required|string',
            'fechaInicioCapacitacion'=>'required|string',
            'fechaFinCapacitacion'=>'required|string',
            'user_id'=>'required|exists:users,id'
        ], self::$messages);
        $capacitacion=$user->capacitacion()->update(new Capacitacion($request->all()));
        return response()->json($capacitacion,200);
    }
    public function delete(Capacitacion $capacitacion,User $user){
        $user->$capacitacion->delete();
        return response()->json(null,204);
    }

}
