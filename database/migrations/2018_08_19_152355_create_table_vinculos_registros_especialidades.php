<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableVinculosRegistrosEspecialidades extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vinculos_registro_especialidades', function (Blueprint $table) {
            $table->unsignedInteger("vinculo_id");
            $table->unsignedInteger("registro_especialidade_id");

            $table->primary(['vinculo_id','registro_especialidade_id'],"vinculos_registro_especialidades_id");

            $table->foreign("vinculo_id")->references("id")->on("vinculos");
            $table->foreign("registro_especialidade_id","registro_regional_especialidade_foreign")->references("id")->on("registros_regional_especialidades");

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
        Schema::dropIfExists('vinculos_registro_especialidades');
    }
}
