<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterRegistrosRegionalAddAlteracoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registros_regional', function (Blueprint $table) {
            $table->string('tipo_registro',10)->nullable(false);
            $table->string('numero',30)->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registros_regional', function (Blueprint $table) {
            $table->dropColumn('tipo_registro');
            $table->string('numero',255)->nullable(true)->change();

        });
    }
}
