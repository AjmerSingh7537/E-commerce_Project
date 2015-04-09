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
            $table->unsignedInteger('category_id');
            $table->string('product_name');
            $table->string('description', 1000);
            $table->float('price');
            $table->integer('quantity');
            $table->string('image');
            $table->float('rating_cache')->default(0.00);
            $table->integer('rating_count')->default(0);
            $table->string('slug')->unique();
            $table->timestamps();
            $table->foreign('category_id')->references('id')->on('categories');
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
