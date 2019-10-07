<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterAtendentesAddAlteracoes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('atendentes', function (Blueprint $table) {
            $table->boolean('bloqueado')->default(false)->nullable(false)->change();
            $table->string('carteira',14)->change();
            $table->string('cnpj',18)->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('atendentes', function (Blueprint $table) {
            $table->integer('bloqueado')->nullable(false)->change();
            $table->string('carteira',255)->change();
            $table->string('cnpj',255)->change();
        });
    }
}
