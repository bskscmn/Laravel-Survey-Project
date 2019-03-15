<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Scale extends Model
{
    protected $guarded = array();
	
    public function question() {
    	 return $this->belongsTo('App\Question'); 
    }
}
