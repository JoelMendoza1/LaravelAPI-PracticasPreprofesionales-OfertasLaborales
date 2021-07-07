<?php

use App\Capacitacion;
use Illuminate\Database\Seeder;
use Tymon\JWTAuth\Facades\JWTAuth;

class CapacitacionesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
         // Vaciar la tabla.
         Capacitacion::truncate();
         $faker = \Faker\Factory::create();
         $pasantes = App\Pasante::all();
         foreach ($pasantes as $pasante) {
             // iniciamos sesión con este usuario de pasante
             JWTAuth::attempt(['email' => $pasante->email, 'password' => '123123']);
             // Y ahora con este usuario creamos una solicitud
             for ($i = 0; $i < 3; $i++) {
                Capacitacion::create([
                    'nombreCapacitacion'=>$faker->text,
                    'nombreInstitucionCapacitadora'=>$faker->company,
                    'fechaInicioCapacitacion'=>$faker->dateTimeThisCentury($max = 'now', $timezone = null),
                    'fechaFinCapacitacion'=>$faker->dateTimeThisCentury($max = 'now', $timezone = null),
                    'pasante_id'=>$pasante->id,
                ]);
            }
         }

    }
}
