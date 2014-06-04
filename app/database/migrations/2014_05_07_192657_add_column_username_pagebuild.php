<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddColumnUsernamePagebuild extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('page_builds',function($table)
		{
			$table->integer("account_id")->after("page_id");
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
		Schema::table("page_builds",function($table)
		{
			$table->dropColumn("account_id");
		}
		);
	}

}
