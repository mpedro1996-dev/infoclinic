<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterDeleteToBloqueadoConselhosRegional extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registros_regional', function (Blueprint $table) {
            $table->renameColumn("delete","bloqueado");
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
            $table->renameColumn("bloqueado","delete");
        });
    }
}
