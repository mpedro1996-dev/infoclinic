<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeysUsuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuarios', function(Blueprint $table)
        {
            $table->foreign('paciente_id')->references('id')->on('pacientes')->nullable(true);
            $table->foreign('clinica_id')->references('id')->on('clinicas')->nullable(true);
            $table->foreign('atendente_id')->references('id')->on('atendentes')->nullable(true);
            $table->foreign('medico_id')->references('id')->on('medicos')->nullable(true);
            $table->foreign('administrador_id')->references('id')->on('administradores')->nullable(true);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarios', function(Blueprint $table)
        {
            $table->dropForeign('usuarios_administrador_id_foreign');
            $table->dropForeign('usuarios_atendente_id_foreign');
            $table->dropForeign('usuarios_clinica_id_foreign');
            $table->dropForeign('usuarios_medico_id_foreign');
            $table->dropForeign('usuarios_paciente_id_foreign');
        });
    }
}
