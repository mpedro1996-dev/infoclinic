<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignEstadoConselhoRegional extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registros_regional', function (Blueprint $table) {
            $table->unsignedInteger('estado_id')->change();
            $table->foreign('estado_id')->references('id')->on('estados');
            $table->unsignedInteger('medico_id')->change();
            $table->foreign('medico_id')->references('id')->on('medicos');

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
            $table->dropForeign('registros_regional_estado_id_foreign');
            $table->unsignedInteger('estado_id')->change();
            $table->dropForeign('registros_regional_medico_id_foreign');
            $table->unsignedInteger('medico_id')->change();


        });
    }
}
