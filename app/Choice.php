<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Choice extends Model
{
	protected $guarded = array();
	
    public function question() {
    	 return $this->belongsTo('App\Question'); 
    }
}
