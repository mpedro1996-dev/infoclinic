<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddDataInauguracaoClinica extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::table('clinicas', function(Blueprint $table)
        {
            $table->date('data_inauguracao')->after('razao_social');
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
            $table->dropColumn('data_inauguracao');
        });

	}

}
