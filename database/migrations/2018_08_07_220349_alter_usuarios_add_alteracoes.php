<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterUsuariosAddAlteracoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->string('nome',100)->nullable(false)->change();
            $table->string('telefone',13)->nullable(false)->change();
            $table->string('celular',14)->nullable(false)->change();
            $table->string('rg',12)->nullable(false)->change();
            $table->date('data_nascimento')->nullable(false)->change();
            $table->string('cep',9)->nullable(false)->change();
            $table->string('logradouro',100)->nullable(false)->change();
            $table->string('numero',10)->nullable(false)->change();
            $table->string('bairro',80)->nullable(false)->change();
            $table->string('complemento',100)->nullable(true)->change();
            $table->string('cidade',40)->nullable(false)->change();
            $table->string('estado',2)->nullable(false)->change();
            $table->string('email',100)->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('usuarios', function (Blueprint $table) {
            $table->string('nome',255)->nullable(true)->change();
            $table->string('telefone',255)->nullable(true)->change();
            $table->string('celular',255)->nullable(true)->change();
            $table->string('rg',255)->nullable(true)->change();
            $table->date('data_nascimento')->nullable(true)->change();
            $table->string('cep',255)->nullable(true)->change();
            $table->string('logradouro',255)->nullable(true)->change();
            $table->string('numero',255)->nullable(true)->change();
            $table->string('bairro',255)->nullable(true)->change();
            $table->string('complemento',255)->nullable(true)->change();
            $table->string('cidade',255)->nullable(true)->change();
            $table->string('estado',255)->nullable(true)->change();
            $table->string('email',255)->nullable(true)->change();

        });
    }
}
