<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScaleAnswer extends Model
{
    protected $guarded = array();

	public function survey() {
    	 return $this->belongsTo('App\Survey');
    }

    public function scaleQuestion() {
         return $this->belongsTo('App\scaleQuestion'); 
    }

}
