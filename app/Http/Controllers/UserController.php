<?php
namespace App\Http\Controllers;
use App\User;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Exceptions\JWTException;
use Tymon\JWTAuth\Exceptions\TokenExpiredException;
use Tymon\JWTAuth\Exceptions\TokenInvalidException;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Resources\User as UserResource;
use App\Http\Resources\UserCollection;
use Illuminate\Support\Facades\Storage;

class UserController extends Controller
{
    private static $messages=[
        'password, confirmed'=>'Confirma la contraseña',
        //'body,required'=>'El body no es valido'
    ];
    public function image(User $user){

       return Storage::download( $user->image);
       //return response()->download(public_path(Storage::url($user->image)), $user->image);
    }
    public function document(User $user){

        return Storage::download( $user->document);
        //return response()->download(public_path(Storage::url($user->image)), $user->image);
     }

    public function index(){
        return new UserCollection(User::orderBy('id', 'DESC')->paginate(10));
    }
    public function index1(){
        $user= User::orderBy('id', 'DESC')->where('request', 'LIKE',1 )->paginate(10);
        return new UserCollection($user);
    }
    public function index2(){
        $user= User::orderBy('id', 'DESC')->where('request', 'LIKE', 0)->paginate(10);
        return new UserCollection($user);
    }
    public function index3(){
        $user= User::orderBy('id', 'DESC')->whereNull('request')->paginate(10);
        return new UserCollection($user);
    }
    public function show(User $user){
        return response()->json(new UserResource($user),200);
    }

    public function updateImgen(Request $request,User $user){
        if($user->image==""){
            $path2 = $request->image -> store('public/usersimages');
            $user->image = $path2;
        }else{
            Storage::delete($user->image);
            $path2 = $request->image -> store('public/usersimages');
            $user->image = $path2;
        }


        //$path2->copy('storage/app/public'.trim($path2, "public"), "public/storage/usersimages");
        //Storage::putFile('usersimages','storage/app/public'.trim($path2, "public") );
        $user->save();
        return response()->json(new UserResource($user),200);
    }
    public function update(Request $request,User $user){
        /*$validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'lastname'=> 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'identificationCard' => 'required|string|max:10|unique:users',
            'telephoneNumber' => 'required|string|max:255',
            'address'=> 'required|string|max:255',
            'dateOfBirth'=> 'required|string|max:255',
            'institution'=> 'required|string|max:255',
        ]);*/
        $user->update($request->all());

        return response()->json($user,200);
    }
    public function updatePasword(Request $request,User $user){
        $checkPassword=Hash::check($request->get('oldpassword'),$user->password) ;
        if($checkPassword){
            $request->validate([
                'password' => 'required|string|min:6|confirmed'
            ], self::$messages);
            $user->password= Hash::make($request->get('password'));
            $user->update();
            return response()->json($user->password,200);
        }else{
            return response()->json(['message'=>'Contraseña anterior incorrecta'],400);
        }
    }
    public function delete(User $user){
        $user->delete();
        return response()->json(null,204);
    }

    public function authenticate(Request $request){
        $credentials = $request->only('email', 'password');
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
            'name' => 'required|string|max:255',
            'lastname'=> 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'password' => 'required|string|min:6|confirmed',
            'document'=> 'required|file',
            'identificationCard' => 'required|string|max:10|unique:users',
            'telephoneNumber' => 'required|string|max:255',
            'address'=> 'required|string|max:255',
            'dateOfBirth'=> 'required|string|max:255',
            'institution'=> 'required|string|max:255',

        ]);

        $user = new User($request->all());
        $path2 = $request->image -> store('public/usersimages');
        $user->image = $path2;
        $path = $request->document->store('public/usersdocuments');
        $user->document = $path;
        $user->password =Hash::make($request->get('password'));



        $user->save();

        /*$user = User::create([
            'name' => $request->get('name'),
            'lastname'=> $request->get('lastname'),
            'email' => $request->get('email'),
            'password' => Hash::make($request->get('password')),
            'document'=> $request->get('document'),
            'identificationCard'=> $request->get('identificationCard'),
            'telephoneNumber'=> $request->get('telephoneNumber'),
            'address'=> $request->get('address'),
            'dateOfBirth'=> $request->get('dateOfBirth'),
            'institution'=> $request->get('institution'),

        ]);*/


        $token = JWTAuth::fromUser($user);
        return response()->json(new UserResource($user, $token), 201);
    }

    public function getAuthenticatedUser(){
        try {
            if (! $user = JWTAuth::parseToken()->authenticate()) {
                return response()->json(['message' => 'user_not_found'], 404);
            }
        } catch (TokenExpiredException $e) {
            return response()->json(['message' => 'token_expired'], $e->getCode());
        } catch (TokenInvalidException $e) {
            return response()->json(['message' => 'token_invalid'], $e->getCode());
        } catch (JWTException $e) {
            return response()->json(['token_absent'], $e->getCode());
        }
        return response()->json(new UserResource($user), 200);
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
