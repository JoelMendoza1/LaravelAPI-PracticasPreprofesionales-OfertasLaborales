<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTrayectorialaboralsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trayectorialaborals', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('Empresa');
            $table->string('PuestoTrabajo');
            $table->string('Responsabilidades');
            $table->string('FechaInicio');
            $table->string('FechaSalida');
            $table->string('Contacto');
            //$table->document('CertificadoLaboral');
            $table->unsignedBigInteger('pasante_id');
            $table->foreign('pasante_id')->references('id')->on('pasantes')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('trayectorialaborals');
    }
}
