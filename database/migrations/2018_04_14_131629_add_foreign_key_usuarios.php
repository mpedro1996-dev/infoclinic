<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddForeignKeyUsuarios extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('usuarios', function(Blueprint $table)
		{
		    $table->integer('paciente_id')->nullable(true)->unsigned()->change();
		    $table->integer('clinica_id')->nullable(true)->unsigned()->change();
		    $table->integer('atendente_id')->nullable(true)->unsigned()->change();
		    $table->integer('medico_id')->nullable(true)->unsigned()->change();
		    $table->integer('administrador_id')->nullable(true)->unsigned()->change();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('usuarios', function(Blueprint $table)
		{
            $table->integer('paciente_id')->nullable(false)->change();
            $table->integer('clinica_id')->nullable(false)->change();
            $table->integer('atendente_id')->nullable(false)->change();
            $table->integer('medico_id')->nullable(false)->change();
            $table->integer('administrador_id')->nullable(false)->change();

		});
	}

}
