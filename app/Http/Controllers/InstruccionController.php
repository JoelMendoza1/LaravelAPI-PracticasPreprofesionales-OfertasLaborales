<?php

namespace App\Http\Controllers;

use App\Instrucion;
use App\Http\Resources\Instruccion as InstruccionResource;
use App\User;
use Illuminate\Http\Request;

class InstruccionController extends Controller
{
    private static $messages=[
        'required'=>'El campo o atributo es obligatorio',
        //'body,required'=>'El body no es valido'
    ];
    public function index(User $user){
        $instrucion = $user->instruccion;
        return  response()->json(InstruccionResource::collection($instrucion),200) ;
    }
    public function show(User $user, Instrucion $instrucion){
        return response()->json($user->instruccion()->where('id',$instrucion->id)->firstOrFail(),200);
    }
    public function store(Request $request, User $user){
        $request->validate([
            'nivelInstrucion'=>'required|string|max:255',
            'institucion'=> 'required|string|max:255',
            'especializacion'=>'required|string|max:255',
            'user_id'=>'required|exists:users,id',
        ], self::$messages);
        $instrucion =$user->instruccion()->save(new Instrucion($request->all()));
        return response()->json($instrucion,201);
    }
    public function update(Request $request,Instrucion $instrucion, User $user){
        $request->validate([
            'nivelInstrucion'=>'required|string|max:255',
            'institucion'=> 'required|string|max:255',
            'especializacion'=>'required|string|max:255',
            'user_id'=>'required|exists:users,id',
        ], self::$messages);
        $instrucion=$user->instruccion()->update(new Instrucion($request->all()));
        return response()->json($instrucion,200);
    }
    public function delete(Instrucion $instrucion,User $user){
        $user->$instrucion->delete();
        return response()->json(null,204);
    }

}
