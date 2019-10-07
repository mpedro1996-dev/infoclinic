<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTableDiasAtendimento extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('dias_atendimento', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('vinculo_id');
            $table->integer('dia_semana');
            $table->time('horario_inicio');
            $table->time('horario_fim');

            $table->foreign('vinculo_id')->references('id')->on('vinculos');
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
        Schema::dropIfExists('dias_atendimento');
    }
}
