<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTablePrescricoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('prescricoes', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome_remedio');
            $table->double('quantidade');
            $table->string('unidade_medida');

            $table->unsignedInteger('consulta_id');
            $table->foreign('consulta_id')->references('id')->on('consultas');
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
        Schema::dropIfExists('prescricoes');
    }
}
