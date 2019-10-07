<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddTipoSanguineoPaciente extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pacientes', function(Blueprint $table)
		{
		    $table->string('tipo_sanguineo')->after('cpf');
		    $table->integer('fator_rh')->nullable();
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
            $table->dropColumn('tipo_sanguineo');
            $table->dropColumn('fator_rh');
		});
	}

}
