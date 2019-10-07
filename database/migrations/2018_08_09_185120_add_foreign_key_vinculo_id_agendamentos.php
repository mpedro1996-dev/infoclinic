<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyVinculoIdAgendamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agendamentos', function (Blueprint $table) {
            $table->foreign('vinculo_id')->references('id')->on('vinculos')->nullable(false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('agendamentos', function (Blueprint $table) {
            $table->dropForeign('agendamentos_vinculo_id_foreign');
        });
    }
}
