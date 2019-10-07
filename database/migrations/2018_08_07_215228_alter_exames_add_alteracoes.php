<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterExamesAddAlteracoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('exames', function (Blueprint $table) {
            $table->string('nome_arquivo')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('exames', function (Blueprint $table) {
            $table->string('nome_arquivo')->nullable(true)->change();

        });
    }
}
