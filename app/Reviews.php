<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Reviews extends Model {

    protected $fillable = ['comment', 'rating'];

    public function getTimeagoAttribute()
    {
        $date = CarbonCarbon::createFromTimeStamp(strtotime($this->created_at))->diffForHumans();
        return $date;
    }

}
