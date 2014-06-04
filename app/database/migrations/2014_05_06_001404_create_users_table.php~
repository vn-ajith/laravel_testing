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
		Schema::create("users",function($table)
		{
			$table->increments("user_id");
			$table->string("username");
			$table->string("email");
			$table->string("password");
			$table->integer("account_id");
			$table->foreign('account_id')->references('account_id')->on('accounts');
			$table->timestamps();
		}
		);
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop("users");
	}

}
