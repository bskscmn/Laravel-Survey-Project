<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Question extends Model
{
	protected $guarded = array();

	public function anket() {
    	 return $this->belongsTo('App\Anket'); 
    }

    public function question_type() {
    	 return $this->belongsTo('App\QuestionType'); 
    }

    public function choices() {
    	 return $this->hasMany('App\Choice'); 
    }
}
