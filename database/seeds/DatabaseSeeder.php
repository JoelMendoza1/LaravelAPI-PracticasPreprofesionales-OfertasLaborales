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
        $this->call(PasanteTableSeeder::class);
        $this->call(SolicitudAprobacionTableSeeder::class);
        $this->call(CapacitacionesTableSeeder::class);
        Schema::enableForeignKeyConstraints();
    }
}
