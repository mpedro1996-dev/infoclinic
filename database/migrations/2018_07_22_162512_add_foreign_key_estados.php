<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyEstados extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('estados', function (Blueprint $table) {
            $table->unsignedInteger('pais_id')->change();
            $table->foreign('pais_id')->references('id')->on('pais');
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
            $table->dropForeign('estados_pais_id_foreign');
            $table->unsignedInteger('pais_id')->change();

        });
    }
}
