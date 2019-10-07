<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddClinicaIdAtendentes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('atendentes', function(Blueprint $table)
		{
		    $table->integer('clinica_id')->after('cnpj');
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
		    $table->dropColumn('clinica_id');
		});
	}

}
