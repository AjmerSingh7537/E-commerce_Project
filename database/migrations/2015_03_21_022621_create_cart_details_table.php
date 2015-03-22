<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCartDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('cart_details', function(Blueprint $table)
        {
            $table->increments('cart_detail_id');
            $table->unsignedInteger('cart_id');
            $table->unsignedInteger('product_id');
            $table->integer('quantity');
            $table->timestamp('created_at');
            $table->foreign('cart_id')->references('cart_id')->on('cart');
            $table->foreign('product_id')->references('product_id')->on('products');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('cart_details');
	}

}
