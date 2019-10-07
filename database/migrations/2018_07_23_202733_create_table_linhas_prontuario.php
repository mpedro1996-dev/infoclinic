<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableLinhasProntuario extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('linhas_prontuario', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('paciente_id');
            $table->unsignedInteger('exame_id');
            $table->unsignedInteger('consulta_id');
            $table->boolean('bloqueado');

            $table->foreign('paciente_id')->references('id')->on('pacientes');
            $table->foreign('exame_id')->references('id')->on('exames');
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
        Schema::dropIfExists('linhas_prontuario');
    }
}
