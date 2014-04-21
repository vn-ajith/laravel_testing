<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageBuilds extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	
		
	
	public function up()
	{
		Schema::create('page_builds',function($table)
			{
				$table->integer('id');
				$table->integer('form_id');
				$table->foreign('form_id')->references('form_id')->on('form_configs');
				$table->text('page_settings');
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('page_builds');
	}

}
