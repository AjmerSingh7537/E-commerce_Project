<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProductsTable extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::create('products', function(Blueprint $table)
        {
            $table->increments('id');
            $table->string('product_name');
            $table->string('description', 1000);
            $table->float('price');
            $table->string('image');
            $table->float('rating_cache')->default(0.00);
            $table->integer('rating_count')->default(0);
            $table->string('slug')->unique();
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
		Schema::drop('products');
	}

}