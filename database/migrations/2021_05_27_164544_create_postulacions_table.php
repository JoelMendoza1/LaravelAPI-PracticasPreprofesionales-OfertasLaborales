<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostulacionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('postulacions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->boolean('estadoPostulacion');
            $table->text('descripcion', null);
            $table->unsignedBigInteger('pasante_id');
            $table->foreign('pasante_id')->references('id')->on('pasantes')->onDelete('cascade')->onUpdate('cascade');
            $table->unsignedBigInteger('oferta_id');
            $table->foreign('oferta_id')->references('id')->on('ofertas')->onDelete('cascade')->onUpdate('cascade');
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
        Schema::dropIfExists('postulacions');
    }
}
