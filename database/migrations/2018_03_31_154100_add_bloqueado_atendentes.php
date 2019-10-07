<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBloqueadoAtendentes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('atendentes', function(Blueprint $table)
		{
			$table->integer('bloqueado')->default(0)->after('clinica_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('atendentes', function(Blueprint $table)
		{
			$table->dropColumn('bloqueado');
		});
	}

}
