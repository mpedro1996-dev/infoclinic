<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveCartaoPlanoPacientes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pacientes', function(Blueprint $table)
		{
			$table->dropColumn('cartao_plano');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pacientes', function(Blueprint $table)
		{
			$table->string('cartao_plano');
		});
	}

}
