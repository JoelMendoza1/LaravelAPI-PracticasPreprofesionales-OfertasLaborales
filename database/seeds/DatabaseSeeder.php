<?php

use App\Empresa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        $this->call(UsersTableSeeder::class);
        $this->call(EmpresaTableSeeder::class);
        $this->call(CapacitacionesTableSeeder::class);
        $this->call(IdiomasTableSeeder::class);
        $this->call(HabilidadesTableSeeder::class);
        $this->call(InstruccionesTableSeeder::class);
        $this->call(TrayectoriasLaboralesTableSeeder::class);
        $this->call(ProyectosTableSeeder::class);
        $this->call(CapacitacionesTableSeeder::class);
        //Postulacion
        //Ofertas
        Schema::enableForeignKeyConstraints();
    }
}
