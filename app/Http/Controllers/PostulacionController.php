<?php

namespace App\Http\Controllers;

use App\Oferta;
use Illuminate\Http\Request;
use App\Http\Resources\Postulacion as PostulacionResorce;
use App\Http\Resources\PostulacionCollection;
use App\Postulacion;
use App\User;

class PostulacionController extends Controller
{
    private static $messages=[
        'required'=>'El campo o atributo es obligatorio',
        'estadoPostulacion,required'=>'El estado de la postulación no es valido',        'estadoPostulacion,required'=>'El estado de la postulación no es valido',
        'descripcion,required'=>'Descripción de la postulación no valido',
        //'user_id,required'=>'el usuario no exixte',
        'oferta_id,required'=>'La oferta no existe',
    ];
    public function index1(Oferta $oferta){
        return response()->json(PostulacionResorce::collection( $oferta->postulacion),200);
    }
    public function index2(User $user){
        return response()->json(PostulacionResorce::collection($user->postulacion),200);
    }
    public function index3(User $user){
        return response()->json(PostulacionResorce::collection($user->postulacion->sortByDesc('created_at')->whereNull('estadoPostulacion')),200);
    }
    public function index4(User $user){
        return response()->json(PostulacionResorce::collection($user->postulacion->sortByDesc('created_at')->where('estadoPostulacion', 'LIKE', 1)),200);
    }
    public function index5(User $user){
        return response()->json(PostulacionResorce::collection($user->postulacion->sortByDesc('created_at')->where('estadoPostulacion', 'LIKE',0)),200);
    }
    public function show(Postulacion $postulacion){
        return response()->json(new PostulacionResorce($postulacion),200);
    }
    public function store(Request $request, User $user){
        $request->validate([
            //'estadoPostulacion'=>'required',
            'descripcion'=> 'required|string|max:255',
            //'user_id'=>'required|exists:users,id',
            'oferta_id'=>'required|exists:ofertas,id'
        ], self::$messages);
        $postulacion =$user->postulacion()->save(new Postulacion($request->all()));
        return response()->json($postulacion,201);
    }
}
