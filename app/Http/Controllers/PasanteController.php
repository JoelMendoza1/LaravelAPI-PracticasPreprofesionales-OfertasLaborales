<?php

namespace App\Http\Controllers;

use App\Pasante;
use Facade\FlareClient\Http\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\Pasante as PasanteResource;
use App\Http\Resources\PasanteCollection;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\JWTGuard;

class PasanteController extends Controller
{
    public function index(){
        return new PasanteCollection(Pasante::paginate());
    }
    public function show(Pasante $pasante){
        return response()->json(new PasanteResource($pasante),200);
    }
    public function store(Request $request){
        $validatedData = $request->validate([
            'Cedula' => 'required|string|max:10',
            'NombrePasante' => 'required|string|max:255',
            'ApellidoPasante' => 'required|string|max:255',
            'TelfPasante' => 'required|string|max:10|min:9',
            'DireccionPasante'=> 'required|string|max:255',
            'EmailPasante' => 'required|string|email|max:255|unique:pasantes',
            'FechaNacimientoPasante' => 'required|string|max:255',
            'ClavePasante' => 'required|string|min:8',
            'CarreraPasante' => 'required|string|max:10',
            'InstitucionCarreraPasante' => 'required|string|max:255',
            'SemestreCarreraPasante' => 'required|string|max:2',
            'TotalSemestresCarreraPasante' => 'required|string|max:2',

        ]);
        $pasante =Pasante::create($validatedData);
        return response()->json($pasante,201);
    }
    public function update(Request $request,Pasante $pasante){
        $pasante->update($request->all());
        return response()->json($pasante,200);
    }
    public function delete(Pasante $pasante){
        $pasante->delete();
        return response()->json(null,204);
    }

    public function authenticate(Request $request){
        $credentials = $request->only('EmailPasante', 'ClavePasante');
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
            'Cedula' => 'required|string|max:10',
            'NombrePasante' => 'required|string|max:255',
            'ApellidoPasante' => 'required|string|max:255',
            'TelfPasante' => 'required|string|max:10|min:9',
            'DireccionPasante'=> 'required|string|max:255',
            'EmailPasante' => 'required|string|email|max:255|unique:pasantes',
            'FechaNacimientoPasante' => 'required|string|max:255',
            'ClavePasante' => 'required|string|min:8|confirmed',
            'CarreraPasante' => 'required|string|max:10',
            'InstitucionCarreraPasante' => 'required|string|max:255',
            'SemestreCarreraPasante' => 'required|string|max:2',
            'TotalSemestresCarreraPasante' => 'required|string|max:2',

        ]);

        $pasante = Pasante::create([
            'Cedula'=>$request->get('Cedula'),
            'NombrePasante' => $request->get('NombrePasante'),
            'ApellidoPasante'=>$request->get('ApellidoPasante'),
            'TelfPasante'=>$request->get('TelfPasante'),
            'DireccionPasante'=>$request->get('DireccionPasante'),
            'EmailPasante' => $request->get('EmailPasante'),
            'FechaNacimientoPasante'=>$request->get('FechaNacimientoPasante'),
            'ClavePasante' => Hash::make($request->get('ClavePasante')),
            'CarreraPasante'=>$request->get('CarreraPasante'),
            'InstitucionCarreraPasante'=>$request->get('InstitucionCarreraPasante'),
            'SemestreCarreraPasante'=>$request->get('SemestreCarreraPasante'),
            'TotalSemestresCarreraPasante'=>$request->get('TotalSemestresCarreraPasante'),
        ]);
        $token = JWTAuth::fromUser($pasante);
        return response()->json(compact('pasante','token'),201);
    }

    public function getAuthenticatedPasante(){
        try {
            if (! $pasante = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'Pasante_not_found'], 404);
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
