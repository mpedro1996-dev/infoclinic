<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameHorariosClinicas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clinicas', function (Blueprint $table) {
            $table->renameColumn('horarioInicioFunc','horario_inicio_func');
            $table->renameColumn('horarioFimFunc','horario_fim_func');
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
            $table->renameColumn('horario_inicio_func','horarioInicioFunc');
            $table->renameColumn('horario_fim_func','horarioFimFunc');
        });
    }
}
