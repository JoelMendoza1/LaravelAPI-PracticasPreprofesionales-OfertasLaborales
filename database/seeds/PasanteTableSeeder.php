<?php

use App\Pasante;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class PasanteTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Vaciar la tabla.
        Pasante::truncate();
        $faker = \Faker\Factory::create();

        $password = Hash::make('123123');
        Pasante::create([
            'Cedula'=>'172804432',
            'NombrePasante'=>'Joel',
            'ApellidoPasante'=>'Mendoza',
            'TelfPasante'=>'0992514455',
            'DireccionPasante'=>'Pifo- Feliciano Vega y Pasaje A E3-17',
            'EmailPasante'=>'joel-777@hotmail.es',
            'FechaNacimientoPasante'=>'29/09/1997',
            'ClavePasante'=>$password,
            'CarreraPasante'=>'Analisis Sistemas Informaticos',
            'InstitucionCarreraPasante'=>'Escuela Politecnica Nacional',
            'SemestreCarreraPasante'=>'6',
            'TotalSemestresCarreraPasante'=>'6',
        ]);
        // Crear artículos ficticios en la tabla
        for ($i = 0; $i < 20; $i++) {
            Pasante::create([
                'Cedula'=>$faker->unique()->buildingNumber,
                'NombrePasante'=>$faker->firstName,
                'ApellidoPasante'=>$faker->lastName,
                'TelfPasante'=>$faker->buildingNumber,
                'DireccionPasante'=>$faker->address,
                'EmailPasante'=>$faker->unique()->email,
                'FechaNacimientoPasante'=>$faker->dateTimeThisCentury($max = 'now', $timezone = null),
                'ClavePasante'=>$password,
                'CarreraPasante'=>$faker->jobTitle,
                'InstitucionCarreraPasante'=>$faker->company,
                'SemestreCarreraPasante'=>$faker->randomElement(['01','02','03','04','05','06']),
                'TotalSemestresCarreraPasante'=>$faker->randomElement(['05','06']),
            ]);
        }
    }
}
