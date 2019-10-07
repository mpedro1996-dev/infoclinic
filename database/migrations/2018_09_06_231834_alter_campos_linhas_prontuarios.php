<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCamposLinhasProntuarios extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('linhas_prontuario', function (Blueprint $table) {
            $table->unsignedInteger('exame_id')->nullable(true)->change();
            $table->unsignedInteger('consulta_id')->nullable(true)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('linhas_prontuario', function (Blueprint $table) {
            $table->unsignedInteger('exame_id')->nullable(false)->change();
            $table->unsignedInteger('consulta_id')->nullable(false)->change();
        });
    }
}
