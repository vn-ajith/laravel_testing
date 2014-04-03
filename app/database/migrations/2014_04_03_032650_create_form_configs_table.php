<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFormConfigsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('form_configs',function($table){
				$table->increments('form_id'); // Form id
				$table->string('form_name','50'); // Form name
				$table->text('form_desc')->nullable();  // Description of form
									// Form description can be null
				$table->text('form_url');  // URL to which form is posted
				$table->integer('field_num');  // Number of fields in form
				$table->text('desc_order');// This field gives idea about order of fields and its descriptions
				$table->timestamps();
				/*
					desc_order = > idea about order fields eg: 3 fields, first single line text, then number then paragraph. It also gives names of fields
				*/
			
			});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('form_configs');
	}

}
