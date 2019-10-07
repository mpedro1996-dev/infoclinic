<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEspecialidadeIdConselhoRegional extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('registros_regional', function(Blueprint $table)
		{
		    $table->integer('especialidade_id')->unsigned()->after('estado_id');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('registros_regional', function(Blueprint $table)
		{
            $table->dropColumn('especialidade_id');
		});
	}

}
