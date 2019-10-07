<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPrescricoesAddAlteracoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('prescricoes', function (Blueprint $table) {
            $table->string('nome_remedio',100)->nullable(false)->change();
            $table->string('unidade_medida',100)->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('prescricoes', function (Blueprint $table) {
            $table->string('nome_remedio',100)->nullable(true)->change();
            $table->string('unidade_medida',100)->nullable(true)->change();
        });
    }
}
