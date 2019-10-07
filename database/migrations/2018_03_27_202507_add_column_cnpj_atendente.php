<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnCnpjAtendente extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('atendentes', function(Blueprint $table)
		{
			$table->string('cnpj')->after('carteira');
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
		    $table->dropColumn('cnpj');
		});
	}

}
