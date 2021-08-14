<?php

namespace App\Http\Controllers;

use App\Proyecto;
use App\Http\Resources\Proyecto as ProyectoResource;
use App\User;
use Illuminate\Http\Request;

class ProyectoController extends Controller
{
    private static $messages=[
        'required'=>'El campo o atributo es obligatorio',
        //'body,required'=>'El body no es valido'
    ];
    public function index(User $user){
        $proyecto = $user->proyecto;
        return  response()->json(ProyectoResource::collection($proyecto),200) ;
    }
    public function show(User $user, Proyecto $proyecto){
        return response()->json($user->proyecto()->where('id',$proyecto->id)->firstOrFail(),200);
    }
    public function store(Request $request, User $user){
        $request->validate([
            'Proyecto'=>'required|string|max:255',
            'link'=> 'required|string|max:255',
            'user_id'=>'required|exists:users,id',
        ],self::$messages);
        $proyecto =$user->proyecto()->save(new Proyecto($request->all()));
        return response()->json($proyecto,201);
    }
    public function update(Request $request,Proyecto $proyecto, User $user){
        $request->validate([
            'Proyecto'=>'required|string|max:255',
            'link'=> 'required|string|max:255',
            'user_id'=>'required|exists:users,id',
        ], self::$messages);
        $proyecto=$user->proyecto()->update(new Proyecto($request->all()));
        return response()->json($proyecto,200);
    }
    public function delete(Proyecto $proyecto,User $user){
        $user->$proyecto->delete();
        return response()->json(null,204);
    }

}
