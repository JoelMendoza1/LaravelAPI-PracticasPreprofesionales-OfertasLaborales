<?php

use App\Empresa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class EmpresaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciar la tabla.
        Empresa::truncate();
        $faker = \Faker\Factory::create();
        // Obtenemos la lista de todos los usuarios creados e
        // iteramos sobre cada uno y simulamos un inicio de
        // sesión con cada uno para crear habilidades en su nombre
        $users = App\User::all();
        foreach ($users as $user) {
            // iniciamos sesión con este usuario
            JWTAuth::attempt(['email' => $user->email, 'password' => '123123']);
            // Y ahora con este usuario creamos algunas habilidades
            Empresa::create([
                'RUC'=>$faker->unique()->buildingNumber,
                'nombreEmpresa'=>$faker->company,
                'tipoEmpresa'=>$faker->text,
                'telefonoEmpresa'=>$faker->buildingNumber,
                'emailEmpresa'=>$faker->unique()->email,
                'direccionEmpresa'=>$faker->address,
                'user_id'=>$user->id,
            ]);

        }
    }

}
