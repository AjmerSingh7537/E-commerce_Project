<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model {

	protected $fillable = [
        'product_name', 'description', 'price', 'image_path', 'rating_cache', 'rating_count'
    ];

}
