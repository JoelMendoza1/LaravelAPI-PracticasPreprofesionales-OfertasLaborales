<?php

use App\SolicitudAprobacion;
use Illuminate\Database\Seeder;
use Tymon\JWTAuth\Facades\JWTAuth;

class SolicitudAprobacionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciar la tabla.
        SolicitudAprobacion::truncate();
        $users= App\User::all();
        foreach ($users as $user){
        $pasantes = App\Pasante::all();
        foreach ($pasantes as $pasante) {
            // iniciamos sesión con este usuario de pasante
            JWTAuth::attempt(['email' => $pasante->email, 'password' => '123123']);
            // Y ahora con este usuario creamos una solicitud
            SolicitudAprobacion::create([
                'estadoSolicitud'=>null,
                'descripcion'=>null,
                'tipo'=>true,
                'empresa_id'=>null,
                'user_id'=>$user->id,
                'pasante_id'=>$pasante->id,
            ]);
        }
        $empresas = App\Empresa::all();
        foreach ($empresas as $empresa) {
            // iniciamos sesión con este usuario de empresa
            JWTAuth::attempt(['email' => $empresa->email, 'password' => '123123']);
            // Y ahora con este usuario creamos una solicitud

                SolicitudAprobacion::create([
                    'estadoSolicitud'=>null,
                    'descripcion'=>null,
                    'tipo'=>false,
                    'empresa_id'=>$empresa->id,
                    'user_id'=>$user->id,
                    'pasante_id'=>null,
                ]);

        }
        }
    }
}
