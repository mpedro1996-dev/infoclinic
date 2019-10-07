<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ModifyCampoDescricaoEspecialidade extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('especialidades', function (Blueprint $table) {
            $table->text('descricao')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('especialidades', function (Blueprint $table) {
            $table->string('descricao')->change();
        });
    }
}
