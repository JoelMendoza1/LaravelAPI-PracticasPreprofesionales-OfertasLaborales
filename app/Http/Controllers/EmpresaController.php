<?php

namespace App\Http\Controllers;

use App\Empresa;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Empresa as EmpresaResourse;
use App\Http\Resources\EmpresaCollection;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\JWTGuard;

class EmpresaController extends Controller
{
    public function index(){
        return new EmpresaCollection( Empresa::paginate());
    }
    public function show(Empresa $empresa){
        return response()->json(new EmpresaResourse( $empresa),200);;
    }
    public function store(Request $request){
        $validatedData =$request->validate([
            'RUC' => 'required|string|max:13',
            'NombreEmpresa' => 'required|string|max:255',
            'TipoEmpresa' => 'required|string|max:255',
            'TelfEmpresa' => 'required|string|max:10|min:9',
            'EmailEmpresa' => 'required|string|email|max:255|unique:pasantes',
            'DireccionEmpresa'=> 'required|string|max:255',
            'ClaveEmpresa' => 'required|string|min:8',
        ]);
        $empresa= Empresa::create($validatedData);
        return response()->json($empresa,201);
    }
    public function update(Request $request,Empresa $empresa){
        $empresa->update($request->all());
        return response()->json($empresa,200);
    }
    public function delete(Empresa $empresa){
        $empresa->delete();
        return response()->json(null,204);
    }
    public function authenticate(Request $request){
        $credentials = $request->only('EmailEmpresa', 'ClaveEmpresa');
        try {
            if (!$token = JWTAuth::attempt($credentials)) {
                return response()->json(['message' => 'invalid_credentials'], 400);
            }
        } catch (JWTException $e) {
            return response()->json(['message' => 'could_not_create_token'], 500);
        }
        $user = JWTAuth::user();
        return response()->json(compact('token', 'user'));
    }

    public function register(Request $request){
        $request->validate([
            'RUC' => 'required|string|max:13',
            'NombreEmpresa' => 'required|string|max:255',
            'TipoEmpresa' => 'required|string|max:255',
            'TelfEmpresa' => 'required|string|max:10|min:9',
            'EmailEmpresa' => 'required|string|email|max:255|unique:pasantes',
            'DireccionEmpresa'=> 'required|string|max:255',
            'ClaveEmpresa' => 'required|string|min:8|confirmed',
        ]);

        $pasante = Empresa::create([
            'RUC'=>$request->get('Cedula'),
            'NombreEmpresa' => $request->get('NombreEmpresa'),
            'TipoEmpresa'=>$request->get('TipoEmpresa'),
            'TelfEmpresa'=>$request->get('TelfEmpresa'),
            'EmailEmpresa'=>$request->get('EmailEmpresa'),
            'DireccionEmpresa' => $request->get('DireccionEmpresa'),
            'ClaveEmpresa' => Hash::make($request->get('ClaveEmpresa')),
        ]);
        $token = JWTAuth::fromUser($pasante);
            return response()->json(compact('pasante','token'),201);
    }

    public function getAuthenticatedEmpresa(){
        try {
            if (! $pasante = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Empresa_not_found'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['message' => 'token_expired'], $e->getCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['message' => 'token_invalid'], $e->getCode());
        } catch (JWTException $e) {
            return response()->json(['message' => 'token_absent'], $e->getCode());
        }
        return response()->json(compact('pasante'));
    }
    public function logout()
    {
        try {
            JWTAuth::invalidate(JWTAuth::getToken());

            return response()->json([
                "status" => "success",
                "message" => "User successfully logged out."
            ], 200);
        } catch (JWTException $e) {
            // something went wrong whilst attempting to encode the token
            return response()->json(["message" => "No se pudo cerrar la sesión."], 500);
        }
    }
}
