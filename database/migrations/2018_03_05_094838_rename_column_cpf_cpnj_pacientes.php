<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RenameColumnCpfCpnjPacientes extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pacientes', function(Blueprint $table)
		{
			$table->renameColumn('cpf_cnpj','cpf');
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
			$table->renameColumn('cpf','cpf_cnpj');
		});
	}

}
