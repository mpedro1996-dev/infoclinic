<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RemoveNotNullAtendentes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('atendentes', function (Blueprint $table) {
            $table->string("carteira")->nullable(true)->change();
            $table->string("cnpj")->nullable(true)->change();
            $table->string("bloqueado")->nullable(true)->change();
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
            $table->string("carteira")->nullable(false)->change();
            $table->string("cnpj")->nullable(false)->change();
            $table->string("bloqueado")->nullable(false)->change();
        });
    }
}
