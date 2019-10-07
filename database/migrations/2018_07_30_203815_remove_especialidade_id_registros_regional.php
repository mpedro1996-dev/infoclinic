<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveEspecialidadeIdRegistrosRegional extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registros_regional', function (Blueprint $table) {
            $table->dropColumn("especialidade_id");
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
            $table->unsignedInteger("especialidade_id")->nullable();
        });
    }
}
