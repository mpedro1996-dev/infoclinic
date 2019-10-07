<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterPaisesAddAlteracoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('paises', function (Blueprint $table) {
            $table->string('nome',100)->nullable(false)->change();
            $table->string('sigla',4)->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('paises', function (Blueprint $table) {
            $table->string('nome',255)->nullable(true)->change();
            $table->string('sigla',255)->nullable(true)->change();
        });
    }
}
