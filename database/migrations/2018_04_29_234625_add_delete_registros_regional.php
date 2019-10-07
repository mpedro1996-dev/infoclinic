<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDeleteRegistrosRegional extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('registros_regional', function(Blueprint $table)
		{
			$table->integer('delete')->default(0)->after('especialidade_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('registros_regional', function(Blueprint $table)
		{
			$table->dropColumn('delete');
		});
	}

}
