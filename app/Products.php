<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model {

	protected $fillable = [
        'category_id', 'product_name', 'description', 'price', 'image', 'slug'
    ];

}
