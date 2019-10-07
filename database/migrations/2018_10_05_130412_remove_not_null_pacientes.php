<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveNotNullPacientes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pacientes', function (Blueprint $table) {
            $table->boolean('fator_rh')->nullable(true)->change();
            $table->string('tipo_sanguineo')->nullable(true)->change();
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
            $table->boolean('fator_rh')->nullable(false)->change();
            $table->string('tipo_sanguineo')->nullable(false)->change();
        });
    }
}
