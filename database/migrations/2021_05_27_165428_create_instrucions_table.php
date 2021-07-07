<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInstrucionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('instrucions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('nivelInstrucion');
            $table->string('institucion');
            $table->string('especializacion');
            //$table->document('Titulo');
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
        Schema::dropIfExists('instrucions');
    }
}
