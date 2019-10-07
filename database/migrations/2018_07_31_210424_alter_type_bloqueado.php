<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTypeBloqueado extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('registros_regional', function (Blueprint $table) {
            $table->boolean("bloqueado")->default(false)->change();
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
            $table->integer("bloqueado")->default(0)->change();
        });
    }
}
