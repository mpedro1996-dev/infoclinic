<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnVinculoIdAgendamentos extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('agendamentos', function (Blueprint $table) {
            $table->unsignedInteger('vinculo_id')->after('id');
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
            $table->dropColumn('vinculo_id');
        });
    }
}
