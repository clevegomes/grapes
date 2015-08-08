<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateContainersTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('containers', function(Blueprint $table)
		{
			$table->increments('id');
			$table->timestamps();
			$table->timestamp('deleted_at')->nullable();
			$table->string('title');
			$table->string('description')->nullable();
			$table->boolean('active')->default(1);
		});

		Schema::create('container_page',function(Blueprint $table){

			$table->integer('container_id')->unsigned()->index();
			$table->foreign('container_id')->references('id')->on('containers')->onDelete('cascade');
			$table->integer('page_id')->unsigned()->index();
			$table->foreign('page_id')->references('id')->on('pages')->onDelete('cascade');
			$table->timestamps();

		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{

		Schema::drop('container_page');
		Schema::drop('containers');
	}

}
