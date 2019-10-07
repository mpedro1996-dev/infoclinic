<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class DeleteRegistrosRegionalEspecialidades extends Migration
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
            $table->unsignedInteger("registros_regional_id");
            $table->unsignedInteger("especialidade_id");

            $table->primary(['registros_regional_id','especialidade_id'],"registros_regional_especialidades_id");

            $table->foreign("registros_regional_id")->references("id")->on("registros_regional");
            $table->foreign("especialidade_id")->references("id")->on("especialidades");

            $table->timestamps();
        });
    }
}
