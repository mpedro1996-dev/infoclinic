<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveRegistrosRegionalEspecialidades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('registros_regional_especialidades');

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::create('registros_regional_especialidades', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger("registros_regional_id");
            $table->unsignedInteger("especialidade_id");

            $table->foreign("registros_regional_id")->references("id")->on("registros_regional");
            $table->foreign("especialidade_id")->references("id")->on("especialidades");
            $table->timestamps();
        });
    }
}
