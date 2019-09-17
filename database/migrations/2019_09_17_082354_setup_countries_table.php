<?php

use Illuminate\Database\Migrations\Migration;

class SetupCountriesTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return  void
	 */
	public function up()
	{
		// Creates the users table
		Schema::create('countries', function($table)
		{
		    $table->increments('id')->unsigned()->index();
		    $table->string('full_name', 255)->nullable();
		    $table->string('name', 255)->default('');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return  void
	 */
	public function down()
	{
		Schema::drop(\Config::get('countries.table_name'));
	}

}
