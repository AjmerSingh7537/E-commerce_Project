<?php namespace App;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model {

    protected $fillable = ['comment', 'ratings'];

    public function user()
    {
        return $this->belongsTo('App\User');
    }

    public function product()
    {
        return $this->belongsTo('App\Products');
    }

}
