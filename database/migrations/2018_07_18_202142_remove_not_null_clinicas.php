<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveNotNullClinicas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clinicas', function (Blueprint $table) {
            $table->time("horarioInicioFunc")->nullable(true)->change();
            $table->time("horarioFimFunc")->nullable(true)->change();
            $table->boolean("domingo")->nullable(true)->change();
            $table->boolean("segunda")->nullable(true)->change();
            $table->boolean("terca")->nullable(true)->change();
            $table->boolean("quarta")->nullable(true)->change();
            $table->boolean("quinta")->nullable(true)->change();
            $table->boolean("sexta")->nullable(true)->change();
            $table->boolean("sabado")->nullable(true)->change();
            $table->string("cep_clinica")->nullable(true)->change();
            $table->string("logradouro_clinica")->nullable(true)->change();
            $table->string("numero_clinica")->nullable(true)->change();
            $table->string("bairro_clinica")->nullable(true)->change();
            $table->string("complemento_clinica")->nullable(true)->change();
            $table->string("cidade_clinica")->nullable(true)->change();
            $table->string("estado_clinica")->nullable(true)->change();
            $table->integer("bloqueado")->default(0)->nullable(true)->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clinicas', function (Blueprint $table) {
            $table->time("horarioInicioFunc")->nullable(false)->change();
            $table->time("horarioFimFunc")->nullable(false)->change();
            $table->boolean("domingo")->nullable(false)->change();
            $table->boolean("segunda")->nullable(false)->change();
            $table->boolean("terca")->nullable(false)->change();
            $table->boolean("quarta")->nullable(false)->change();
            $table->boolean("quinta")->nullable(false)->change();
            $table->boolean("sexta")->nullable(false)->change();
            $table->boolean("sabado")->nullable(false)->change();
            $table->string("cep_clinica")->nullable(false)->change();
            $table->string("logradouro_clinica")->nullable(false)->change();
            $table->string("numero_clinica")->nullable(false)->change();
            $table->string("bairro_clinica")->nullable(false)->change();
            $table->string("complemento_clinica")->nullable(false)->change();
            $table->string("cidade_clinica")->nullable(false)->change();
            $table->string("estado_clinica")->nullable(false)->change();
            $table->integer("bloqueado")->default(0)->nullable(false)->change();

        });
    }
}
