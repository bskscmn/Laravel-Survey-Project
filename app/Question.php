<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	public function anket() {
    	 return $this->belongsTo('App\Anket'); 
    }

    public function questionType() {
    	 return $this->belongsTo('App\QuestionType'); 
    }

    public function choices() {
    	 return $this->hasMany('App\Choice'); 
    }
}