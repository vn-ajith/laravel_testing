<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products',function($table)
		{
			$table->increments('id');
			$table->string('product_name');
			$table->float('price');
			$table->string('product_desc')->nullable();
			$table->integer('quantity')->nullable();
			$table->float('size')->nullable();
			
			
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('products');
	}

}
