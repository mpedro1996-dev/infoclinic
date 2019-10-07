<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnsPaciente extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('pacientes',function(Blueprint $table){
			$table->string('cartao_plano')->after('cpf_cnpj');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('pacientes',function(Blueprint $table){
			$table->dropColumn('cartao_plano');
		});
	}

}
