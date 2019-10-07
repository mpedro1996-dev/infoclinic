<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnClinica extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('clinicas',function(Blueprint $table){
			$table->string('descricao');
			$table->time('horarioInicioFunc');
			$table->time('horarioFimFunc');
			$table->boolean('domingo');
			$table->boolean('segunda');
			$table->boolean('terca');
			$table->boolean('quarta');
			$table->boolean('quinta');
			$table->boolean('sexta');
			$table->boolean('sabado');
			$table->integer('administrador_id');

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('clinicas',function(Blueprint $table){
			$table->dropColumn('descricao');
			$table->dropColumn('horarioInicioFunc');
			$table->dropColumn('horarioFimFunc');
			$table->dropColumn('domingo');
			$table->dropColumn('segunda');
			$table->dropColumn('terca');
			$table->dropColumn('quarta');
			$table->dropColumn('quinta');
			$table->dropColumn('sexta');
			$table->dropColumn('sabado');
			$table->dropColumn('administrador_id');
		});
	}

}
