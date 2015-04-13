<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart_details extends Model {

	protected $table = 'cart_details';

    public function cart()
    {
        return $this->belongsTo('App\Cart');
    }

    public function product()
    {
        return $this->hasMany('App\Products');
    }

}
