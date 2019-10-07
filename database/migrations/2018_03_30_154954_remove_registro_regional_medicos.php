<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveRegistroRegionalMedicos extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('medicos', function(Blueprint $table)
		{
			$table->dropColumn('registro_regional');
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
			$table->string('registro_regional');
		});
	}

}
