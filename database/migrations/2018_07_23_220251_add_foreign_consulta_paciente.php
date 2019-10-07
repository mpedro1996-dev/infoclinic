<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignConsultaPaciente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consultas', function (Blueprint $table) {
            $table->unsignedInteger('paciente_id');
            $table->foreign('paciente_id')->references('id')->on('pacientes');
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
            $table->dropForeign('consultas_paciente_id_foreign');
            $table->dropColumn('paciente_id');
        });
    }
}
