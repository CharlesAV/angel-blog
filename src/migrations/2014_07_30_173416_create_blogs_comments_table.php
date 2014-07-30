<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateBlogsCommentsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('blogs_comments', function(Blueprint $table)
		{
			$table->increments('id');
			$table->integer('blog_id')->unsigned()->nullable();
			$table->integer('user_id')->unsigned()->nullable();
			$table->string('user_name');
			$table->string('user_email');
			$table->text('text');
			$table->timestamps(); // Adds `created_at` and `updated_at` columns
			$table->softDeletes(); // Adds `deleted_at` column
			
			$table->foreign('blog_id')->references('id')->on('blogs');
			$table->foreign('user_id')->references('id')->on('users');
		});
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('blogs_comments');
	}

}
