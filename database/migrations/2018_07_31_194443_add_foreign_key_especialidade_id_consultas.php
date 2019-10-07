<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyEspecialidadeIdConsultas extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('consultas', function (Blueprint $table) {
            $table->foreign("especialidade_id")->references("id")->on("especialidades");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('consultas', function (Blueprint $table) {
            $table->dropForeign("consultas_especialidade_id_foreign");
        });
    }
}
