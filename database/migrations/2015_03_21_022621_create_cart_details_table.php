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
            $table->integer('cart_id');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->timestamp('created_at');
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
