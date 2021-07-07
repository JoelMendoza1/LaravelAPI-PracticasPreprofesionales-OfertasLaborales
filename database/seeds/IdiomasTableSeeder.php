<?php

use App\Idioma;
use Illuminate\Database\Seeder;
use Tymon\JWTAuth\Facades\JWTAuth;

class IdiomasTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciar la tabla articles.
        Idioma::truncate();
        $faker = \Faker\Factory::create();
        // Obtenemos la lista de todos los usuarios creados e
        // iteramos sobre cada uno y simulamos un inicio de
        // sesión con cada uno para crear artículos en su nombre
        $pasantes = App\Pasante::all();
        foreach ($pasantes as $pasante) {
            // iniciamos sesión con este usuario
            JWTAuth::attempt(['EmailPasante' => $pasante->email, 'ClavePasante' => '123123']);
            // Y ahora con este usuario creamos algunos articulos
            $num_idiomas = 5;
            for ($j = 0; $j < $num_idiomas; $j++) {
                Idioma::create([
                    'idioma' => $faker->sentence,
                    'nivel' => $faker->sentence,
                ]);
            }
        }
    }
}
