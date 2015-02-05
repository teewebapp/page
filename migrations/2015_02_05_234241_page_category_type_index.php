<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PageCategoryTypeIndex extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::table('page_categories', function(Blueprint $table)
		{
			$table->index('type');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::table('page_categories', function(Blueprint $table)
		{
			$table->dropIndex('type');
		});
	}

}
