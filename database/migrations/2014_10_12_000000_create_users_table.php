<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('usuarios', function(Blueprint $table)
		{
			$table->increments('id');
			//Dados Pessoais
			$table->string('nome');
			$table->string('telefone');
			$table->string('celular');
			$table->string('rg');
			$table->date('data_nascimento');
			//Endereco
			$table->string('cep');
			$table->string('logradouro');
			$table->string('numero');
			$table->string('bairro');
			$table->string('complemento');
			$table->string('cidade');
			$table->string('estado');
			//Permissoes
			$table->integer('medico_id');//Medico
			$table->integer('paciente_id');//Paciente
			$table->integer('clinica_id');//Clinica
			$table->integer('atendente_id');//Atendente

			$table->string('email')->unique();
			$table->string('password', 60);
			$table->rememberToken();
			$table->timestamps();
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('usuarios');
	}

}
