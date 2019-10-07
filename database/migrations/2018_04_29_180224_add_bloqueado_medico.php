<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBloqueadoMedico extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('medicos', function(Blueprint $table)
		{
			$table->integer('bloqueado')->default(0)->after('id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('medicos', function(Blueprint $table)
		{
			$table->dropColumn('bloqueado');
		});
	}

}
