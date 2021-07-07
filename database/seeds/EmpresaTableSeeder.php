<?php

use App\Empresa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

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
        $password = Hash::make('123123');
        Empresa::create([
            'RUC'=>'1720804432',
            'NomEmpresa'=>'Escuela Politecnica Nacional',
            'TipoEmpresa'=>'Publica',
            'TelfEmpresa'=>'0992514455',
            'EmailEmpresa'=>'wester.mendoza@epn.edu.ec',
            'DireccionEmpresa'=>'Quito - Ladron de Guevara',
            'ClaveEmpresa'=>$password,
        ]);
        // Crear datos ficticios en la tabla
        for ($i = 0; $i < 20; $i++) {
            Empresa::create([
                'RUC'=>$faker->unique()->buildingNumber,
                'NomEmpresa'=> $faker->company,
                'TipoEmpresa'=>$faker->text,
                'TelfEmpresa'=>$faker->buildingNumber,
                'EmailEmpresa'=>$faker->unique()->email,
                'DireccionEmpresa'=>$faker->address,
                'ClaveEmpresa'=>$password,
            ]);

        }
    }

}
