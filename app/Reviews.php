<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model {

    protected $fillable = ['comment', 'rating'];

    public function getTimeagoAttribute($date)
    {
        $re = new Reviews();
        $date->diffForHumans();
    }

}
