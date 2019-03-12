<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class QuestionType extends Model
{
    public function questions() {
    	return $this->hasMany('App\Question'); 
    }
}
