<?php namespace App;

use Illuminate\Database\Eloquent\Model;

class Users_type extends Model {

    protected $table = 'users_type';

	public function users()
    {
        return $this->hasMany('App\User');
    }

}
