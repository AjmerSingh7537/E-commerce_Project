<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateReviewsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('reviews', function(Blueprint $table)
        {
            $table->increments('review_id');
            $table->unsignedInteger('product_id');
            $table->unsignedInteger('user_id');
            $table->string('comment', 500);
            $table->tinyInteger('approved');
            $table->tinyInteger('spam');
            $table->timestamps();
            $table->foreign('product_id')->references('product_id')->on('products');
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
		Schema::drop('reviews');
	}

}
