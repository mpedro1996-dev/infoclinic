<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCamposConsulta extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consultas', function (Blueprint $table) {
            $table->string('queixa_principal',1000)->change();
            $table->string('principais_sintomas',1000)->change();
            $table->string('exame_fisico',1000)->change();
            $table->string('hipotese_diagnostica',1000)->change();
            $table->string('orientacao',1000)->change();

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
            $table->string('queixa_principal',255)->change();
            $table->string('principais_sintomas',255)->change();
            $table->string('exame_fisico',255)->change();
            $table->string('hipotese_diagnostica',255)->change();
            $table->string('orientacao',255)->change();

        });
    }
}
