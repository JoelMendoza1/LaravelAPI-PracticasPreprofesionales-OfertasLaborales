<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHabilidadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('habilidads', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->text('descripcion');
            $table->string('dominio');
            $table->string('habilidad');
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
        Schema::dropIfExists('habilidads');
    }
}
