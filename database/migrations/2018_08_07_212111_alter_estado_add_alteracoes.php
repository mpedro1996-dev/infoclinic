<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterEstadoAddAlteracoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estados', function (Blueprint $table) {
            $table->string('nome',100)->nullable(false)->change();
            $table->string('uf',2)->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('estados', function (Blueprint $table) {
            $table->string('nome',255)->nullable(true)->change();
            $table->string('uf',255)->nullable(true)->change();

        });
    }
}
