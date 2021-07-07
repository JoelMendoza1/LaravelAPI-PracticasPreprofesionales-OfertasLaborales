<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePasantesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pasantes', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('Cedula',10)->unique();
            $table->string('NombrePasante');
            $table->string('ApellidoPasante');
            $table->string('TelfPasante',10);
            $table->string('DireccionPasante');
            $table->string('EmailPasante')->unique();
            $table->string('FechaNacimientoPasante');
            $table->string('ClavePasante',150);
            $table->string('CarreraPasante');
            $table->string('InstitucionCarreraPasante');
            $table->string('SemestreCarreraPasante',2);
            $table->string('TotalSemestresCarreraPasante',2);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('pasantes');
    }
}
