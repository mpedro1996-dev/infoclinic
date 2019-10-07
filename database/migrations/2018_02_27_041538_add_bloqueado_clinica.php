<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddBloqueadoClinica extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('clinicas', function(Blueprint $table)
		{
			$table->integer('bloqueado');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('clinicas', function(Blueprint $table)
		{
			$table->dropColumn('bloqueado');
		});
	}

}
