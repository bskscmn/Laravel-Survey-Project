<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	protected $guarded = array();

	public function anket() {
    	 return $this->belongsTo('App\Anket'); 
    }

    public function questionType() {
    	 return $this->belongsTo('App\QuestionType'); 
    }

    public function scaleType() {
         return $this->belongsTo('App\ScaleType'); 
    }

    public function scaleQuestions() {
         return $this->hasMany('App\ScaleQuestion'); 
    }

    public function choices() {
         return $this->hasMany('App\Choice'); 
    }
}
