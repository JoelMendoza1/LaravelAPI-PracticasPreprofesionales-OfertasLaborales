<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSolicitudaprobacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solicitudaprobacions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('estadoSolicitud')->nullable();
            $table->text('descripcion')->nullable();
            $table->boolean('tipo');
            $table->unsignedBigInteger('empresa_id')->nullable();
            $table->foreign('empresa_id')->references('id')->on('empresas')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('pasante_id')->nullable();
            $table->foreign('pasante_id')->references('id')->on('pasantes')->onDelete('restrict')->onUpdate('restrict');
            $table->unsignedBigInteger('user_id')->nullable();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('restrict')->onUpdate('restrict');
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
        Schema::dropIfExists('solicitudaprobacions');
    }
}
