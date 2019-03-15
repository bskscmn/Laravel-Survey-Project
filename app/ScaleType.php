<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScaleType extends Model
{
	
    public function question() {
    	 return $this->hasMany('App\Question'); 
    }
}
