<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageCategories extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('page_categories', function(Blueprint $table) {
			$table->increments('id');
			$table->string('name');
			$table->string('type', 30);
			$table->timestamps();
		});

		Schema::table('pages', function(Blueprint $table) {
			$table->unsignedInteger('page_category_id')->nullable();
			$table->foreign('page_category_id')->references('id')->on('page_categories');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('page_categories');
	}

}
