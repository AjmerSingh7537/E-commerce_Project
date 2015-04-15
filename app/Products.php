<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Products extends Model {

	protected $fillable = [
        'category_id', 'product_name', 'description', 'price', 'image', 'slug', 'quantity'
    ];

    public function reviews()
    {
        return $this->hasMany('App\Reviews', 'product_id');
    }

    public function cart_details()
    {
        return $this->belongsTo('App\Cart_details');
    }

    public function category()
    {
        return $this->belongsTo('App\Categories');
    }

}
