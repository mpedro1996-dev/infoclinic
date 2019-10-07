<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnBloqueadoAdministrador extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('administradores', function(Blueprint $table)
		{
			$table->integer('bloqueado')->after('permissao_especial');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('administradores', function(Blueprint $table)
		{
			$table->dropColumn('bloqueado');
		});
	}

}
