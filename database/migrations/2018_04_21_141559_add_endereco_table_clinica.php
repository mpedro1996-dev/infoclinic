<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddEnderecoTableClinica extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('clinicas', function(Blueprint $table)
		{
            //Endereco
            $table->string('cep_clinica');
            $table->string('logradouro_clinica');
            $table->string('numero_clinica');
            $table->string('bairro_clinica');
            $table->string('complemento_clinica');
            $table->string('cidade_clinica');
            $table->string('estado_clinica');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('clinicas', function(Blueprint $table)
		{
            //Endereco
            $table->dropColumn('cep_clinica');
            $table->dropColumn('logradouro_clinica');
            $table->dropColumn('numero_clinica');
            $table->dropColumn('bairro_clinica');
            $table->dropColumn('complemento_clinica');
            $table->dropColumn('cidade_clinica');
            $table->dropColumn('estado_clinica');
		});
	}

}
