<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPacientesAddAlteracoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->string('cpf',14)->unique()->nullable(false)->change();
            $table->string('tipo_sanguineo',2)->nullable(false)->change();
            $table->boolean('fator_rh')->nullable(false)->change();
            $table->string('sexo',1)->nullable(false);
            $table->string('estado_civil',15)->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->string('cpf',255)->change();
            $table->string('tipo_sanguineo',255)->nullable(true)->change();
            $table->dropColumn('sexo');
            $table->dropColumn('estado_civil');
            $table->dropUnique('pacientes_cpf_unique');

        });
    }
}
