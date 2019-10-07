<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAdministradoresAddAlteracoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('administradores', function (Blueprint $table) {
            $table->boolean('permissao_especial')->default(false)->nullable(false)->change();
            $table->boolean('bloqueado')->default(false)->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('administradores', function (Blueprint $table) {
            $table->integer('permissao_especial')->nullable(false)->change();
            $table->integer('bloqueado')->nullable(false)->change();
        });
    }
}
