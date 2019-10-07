<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterClinicasAddAlteracoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('clinicas', function (Blueprint $table) {
            $table->boolean('bloqueado')->default(false)->nullable(false)->change();
            $table->string('cnpj',18)->nullable(false)->unique()->change();
            $table->string('razao_social',100)->nullable(false)->unique()->change();
            $table->string('cep_clinica',9)->nullable(true)->change();
            $table->string('logradouro_clinica',100)->nullable(true)->change();
            $table->string('numero_clinica',10)->nullable(true)->change();
            $table->string('bairro_clinica',80)->nullable(true)->change();
            $table->string('complemento_clinica',100)->nullable(true)->change();
            $table->string('cidade_clinica',40)->nullable(true)->change();
            $table->string('estado_clinica',2)->nullable(true)->change();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('clinicas', function (Blueprint $table) {
            $table->integer('bloqueado')->nullable(false)->change();
            $table->string('cnpj',255)->nullable(false)->change();
            $table->string('razao_social',255)->nullable(false)->change();
            $table->string('cep_clinica',255)->nullable(true)->change();
            $table->string('logradouro_clinica',255)->nullable(true)->change();
            $table->string('numero_clinica',255)->nullable(true)->change();
            $table->string('bairro_clinica',255)->nullable(true)->change();
            $table->string('complemento_clinica',255)->nullable(true)->change();
            $table->string('cidade_clinica',255)->nullable(true)->change();
            $table->string('estado_clinica',255)->nullable(true)->change();
            $table->dropUnique('clinicas_cnpj_unique');
            $table->dropUnique('clinicas_razao_social_unique');
        });
    }
}
