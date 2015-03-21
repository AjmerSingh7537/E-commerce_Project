<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOrderDetailsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
        Schema::create('order_details', function(Blueprint $table)
        {
            $table->increments('order_detail_id');
            $table->integer('order_id');
            $table->integer('product_id');
            $table->integer('quantity');
            $table->timestamp('created_at');
            $table->string('status');
        });
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::drop('order_details');
	}

}
