<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignClinicaAtendente extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('atendentes', function (Blueprint $table) {
            $table->unsignedInteger('clinica_id')->change();
            $table->foreign('clinica_id')->references('id')->on('clinicas');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('atendentes', function (Blueprint $table) {
            $table->unsignedInteger('clinica_id')->change();
            $table->dropForeign('atendentes_clinica_id_foreign');
        });
    }
}
