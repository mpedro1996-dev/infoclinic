<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnAdministrador extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('administradores',function(Blueprint $table){
			$table->integer('permissao_especial')->after('id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('administradores',function(Blueprint $table){
			$table->dropColumn('permissao_especial');
		});
	}

}
