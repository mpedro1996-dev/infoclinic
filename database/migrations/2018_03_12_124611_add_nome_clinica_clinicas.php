<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddNomeClinicaClinicas extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('clinicas', function(Blueprint $table)
		{
			$table->string('razao_social')->after('cnpj');
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
			$table->dropColumn('razao_social');
		});
	}

}
