<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnAdministradorUsuarios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('usuarios',function(Blueprint $table){
			$table->renameColumn('administrador','administrador_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('usuarios',function(Blueprint $table){
			$table->renameColumn('administrador_id','administrador');
		});
	}

}
