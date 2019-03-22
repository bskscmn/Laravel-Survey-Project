<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ScaleAnswer extends Model
{
    protected $guarded = array();

	public function anket() {
    	 return $this->belongsTo('App\Anket'); 
    }

    public function scaleQuestion() {
         return $this->belongsTo('App\scaleQuestion'); 
    }

}
