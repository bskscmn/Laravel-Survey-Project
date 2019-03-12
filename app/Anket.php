<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anket extends Model
{
	protected $guarded = array();

    public function questions() {
    	return $this->hasMany('App\Question'); 
    }
}
