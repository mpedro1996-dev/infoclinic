<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignEspecialidadeConselho extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registros_regional', function(Blueprint $table)
        {
            $table->foreign('especialidade_id')->references('id')->on('especialidades');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('registros_regional', function(Blueprint $table)
        {
            $table->dropForeign('registros_regional_especialidade_id_foreign');
        });
    }
}
