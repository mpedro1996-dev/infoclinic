<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignAdministradorClinica extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clinicas', function (Blueprint $table) {
            $table->unsignedInteger('administrador_id')->change();
            $table->foreign('administrador_id')->references('id')->on('administradores');
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
            $table->dropForeign('clinicas_administrador_id_foreign');
            $table->unsignedInteger('administrador_id')->change();
        });
    }
}
