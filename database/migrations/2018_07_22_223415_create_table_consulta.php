<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableConsulta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('consultas', function (Blueprint $table) {
            $table->increments('id');
            $table->string('queixa_principal');
            $table->string('principais_sintomas');
            $table->string('exame_fisico');
            $table->string('hipotese_diagnostica');
            $table->string('orientacao');
            $table->integer('status');
            $table->string('justificativa')->nullable(true);

            $table->unsignedInteger('retorno_id')->nullable(true);
            $table->unsignedInteger('agendamento_id')->nullable(true);
            $table->foreign('agendamento_id')->references('id')->on('agendamentos');
            $table->foreign('retorno_id')->references('id')->on('consultas');
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
        Schema::dropIfExists('consultas');
    }
}
