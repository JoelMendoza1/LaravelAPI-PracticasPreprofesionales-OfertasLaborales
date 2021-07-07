<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEmpresasTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('empresas', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->String('RUC',13)->unique();
            $table->string('NomEmpresa');
            $table->string('TipoEmpresa');
            $table->string('TelfEmpresa',10);
            $table->string('EmailEmpresa')->unique();
            $table->string('DireccionEmpresa');
            $table->string('ClaveEmpresa');
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
        Schema::dropIfExists('empresas');
    }
}
