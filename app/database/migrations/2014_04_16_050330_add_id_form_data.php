<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddIdFormData extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('form_datas', function($table)
		{
    			$table->increments('id')->after('form_id'); 
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('form_datas', function($table)
		{
    			$table->dropColumn('id');
			
		});
	}

}
