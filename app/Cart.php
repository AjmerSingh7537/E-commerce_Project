<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model {

    protected $table = 'cart';

    protected $fillable = ['user_id', 'total_quantity', 'total_balance'];

}
