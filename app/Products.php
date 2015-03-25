<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model {

	protected $fillable = [
        'product_name', 'description', 'price', 'image', 'slug'
    ];

}
