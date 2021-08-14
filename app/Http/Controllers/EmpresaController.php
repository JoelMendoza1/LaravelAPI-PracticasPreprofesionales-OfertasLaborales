<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use App\User;
use App\Http\Resources\Empresa as EmpresaResourse;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
class EmpresaController extends Controller
{
    private static $messages=[
        'required'=>'El campo o atributo es obligatorio',
        //'body,required'=>'El body no es valido'
    ];
    public function index(User $user){

        return response()->json(EmpresaResourse::collection($user->empresa),200);
    }

    public function show(User $user, Empresa $empresa){
        return response()->json($user->capacitacion()->where('id',$empresa->id)->firstOrFail(),200);
    }
    public function store(Request $request, User $user){
        $request->validate([
            'RUC' => 'required|string|max:13',
            'nombreEmpresa' => 'required|string|max:255',
            'tipoEmpresa' => 'required|string|max:255',
            'telfEmpresa' => 'required|string|max:10|min:9',
            'emailEmpresa' => 'required|string|email|max:255|unique:pasantes',
            'direccionEmpresa'=> 'required|string|max:255',
            'user_id'=> 'required|exists:users,id',
        ], self::$messages);
        $empresa =$user->empresa()->save(new Empresa($request->all()));
        return response()->json($empresa,201);
    }
    public function update(Request $request,Empresa $empresa, User $user){
        $request->validate([
            'RUC' => 'required|string|max:13',
            'nombreEmpresa' => 'required|string|max:255',
            'tipoEmpresa' => 'required|string|max:255',
            'telfEmpresa' => 'required|string|max:10|min:9',
            'emailEmpresa' => 'required|string|email|max:255|unique:pasantes',
            'direccionEmpresa'=> 'required|string|max:255',
            'user_id'=> 'required|exists:users,id',
        ], self::$messages);
        $empresa=$user->empresa()->update(new Empresa($request->all()));
        return response()->json($empresa,200);
    }
    public function delete(Empresa $empresa,User $user){
        $user->$empresa->delete();
        return response()->json(null,204);
    }
}
