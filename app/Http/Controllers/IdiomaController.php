<?php

namespace App\Http\Controllers;

use App\Http\Resources\Idioma as IdiomaResource;
use App\Idioma;
use App\User;
use Illuminate\Http\Request;

class IdiomaController extends Controller
{
    private static $messages=[
        'required'=>'El campo o atributo es obligatorio',
        //'body,required'=>'El body no es valido'
    ];
    public function index(User $user){
        return  response()->json(IdiomaResource::collection($user->idioma),200);
    }
    public function show(User $user, Idioma $idioma){
        return response()->json($user->idioma()->where('id',$idioma->id)->firstOrFail(),200);
    }
    public function store(Request $request, User $user){
        $request->validate([
            'idioma'=>'required|string|max:255',
            'nivel'=> 'required|string|max:255',
            'user_id'=>'required|exists:users,id',
        ],self::$messages);
        $idioma =$user->idioma()->save(new Idioma($request->all()));
        return response()->json($idioma,201);
    }
    public function update(Request $request,Idioma $idioma, User $user){
        $request->validate([
            'idioma'=>'required|string|max:255',
            'nivel'=> 'required|string|max:255',
            'user_id'=>'required|exists:users,id',
        ], self::$messages);
        $idioma=$user->idioma()->update(new Idioma($request->all()));
        return response()->json($idioma,200);
    }
    public function delete(Idioma $idioma,User $user){
        $user->$idioma->delete();
        return response()->json(null,204);
    }

}
