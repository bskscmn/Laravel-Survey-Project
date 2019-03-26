<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Answer;
use App\ScaleAnswer;
use App\Anket;
use App\Question;
use App\ScaleQuestion;

class AnswerController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index($anketid)
    {
    	$survey = Anket::findOrFail($anketid);
        return view('surveyscroll', compact('survey'));
    }


    public function store(Request $request, $anketid)
    {
   
    	$userid = Answer::max('user_id') +1;

		foreach($request->except(['_token']) as $key => $val) {
	     	  
			$keyArr = explode("-", $key);

	        if ($keyArr[0] == "questionID") {

	        	$qid = $keyArr[1];
	        	$question = Question::findOrFail($qid);

	        	switch ($question->question_type_id) {
				    case 1:
				    	$answer = Answer::create([
				            'user_id' => $userid,
				            'anket_id' => $anketid,
				            'question_id' => $qid,
				            'choice_id' => $val,
				        ]);
				        break;
				    case 2:
				    	foreach($val as $value) {
					        $answer = Answer::create([
					            'user_id' => $userid,
					            'anket_id' => $anketid,
					            'question_id' => $qid,
					            'choice_id' => $value,
					        ]);
					    }
				        break;
				    case 3:
				    	if($val!=0){
				    		$answer = Answer::create([
					            'user_id' => $userid,
					            'anket_id' => $anketid,
					            'question_id' => $qid,
					            'choice_id' => $val,
					        ]);
				    	}else{
				    		$other="other-".$qid;
				    		$answer = Answer::create([
					            'user_id' => $userid,
					            'anket_id' => $anketid,
					            'question_id' => $qid,
					            'input_value' => $request->$other,
					        ]);
				    	}
				        break;
				    case 4:
			    		foreach($val as $value) {
			    			if($value!=0){
						        $answer = Answer::create([
						            'user_id' => $userid,
						            'anket_id' => $anketid,
						            'question_id' => $qid,
						            'choice_id' => $value,
						        ]);
						    }else{
					    		$other="other-".$qid;
					    		$answer = Answer::create([
						            'user_id' => $userid,
						            'anket_id' => $anketid,
						            'question_id' => $qid,
						            'input_value' => $request->$other,
						        ]);
					    	}
				    	}
				        break;
				    case 6:
				    	if ($val) {
					    	$answer = Answer::create([
					            'user_id' => $userid,
					            'anket_id' => $anketid,
					            'question_id' => $qid,
					            'input_value' => $val,
					        ]);	
				    	}
				        
				        break;
				    default:
				        return "Something went wrong";
				}

	        }elseif ($keyArr[0] == "scaleQuestionID"){
	        	$sqid = $keyArr[1];
	        	$scaleQuestion = ScaleQuestion::findOrFail($sqid);
	        	$answer = ScaleAnswer::create([
		            'user_id' => $userid,
		            'anket_id' => $anketid,
		            'scale_question_id' => $sqid,
		            'answer' => $val,
		        ]);
	        }
	       
	    }
     	$anket = Anket::findOrFail($anketid);
	    return view('surveyend', compact('anket'));
    }
}
