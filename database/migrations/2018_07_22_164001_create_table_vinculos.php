<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVinculos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vinculos', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('registro_id');
            $table->unsignedInteger('clinica_id');

            $table->foreign('registro_id')->references('id')->on('registros_regional');
            $table->foreign('clinica_id')->references('id')->on('clinicas');

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vinculos');
    }
}
