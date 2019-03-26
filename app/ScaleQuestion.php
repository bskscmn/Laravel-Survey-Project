<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScaleQuestion extends Model
{
    protected $guarded = array();
	
    public function question() {
    	 return $this->belongsTo('App\Question'); 
    }

    public function scaleAnswers() {
    	return $this->hasMany('App\ScaleAnswer'); 
    }
}
