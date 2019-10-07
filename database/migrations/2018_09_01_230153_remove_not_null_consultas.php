<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveNotNullConsultas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consultas', function (Blueprint $table) {
            $table->string("queixa_principal")->nullable(true)->change();
            $table->string("principais_sintomas")->nullable(true)->change();
            $table->string("exame_fisico")->nullable(true)->change();
            $table->string("hipotese_diagnostica")->nullable(true)->change();
            $table->string("orientacao")->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consultas', function (Blueprint $table) {
            $table->string("queixa_principal")->nullable(false)->change();
            $table->string("principais_sintomas")->nullable(false)->change();
            $table->string("exame_fisico")->nullable(false)->change();
            $table->string("hipotese_diagnostica")->nullable(false)->change();
            $table->string("orientacao")->nullable(false)->change();
        });
    }
}
