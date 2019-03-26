<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anket;
use App\Answer;
use App\QuestionType;
use App\ScaleType;

class AnalyticsController extends Controller
{
	/**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$surveys = Anket::all();
        return view('analytics.surveylist', compact('surveys'));
    }

        /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$survey = Anket::findOrFail($id);
        $questionTypes = QuestionType::all();
        $scaleTypes = ScaleType::all();
        return view('analytics.analytics', compact('survey', 'questionTypes', 'scaleTypes'));
    }

    public function others($survey_id, $id)
    {
    	$survey = Anket::findOrFail($survey_id);
    	$answers = Answer::where('question_id', $id)->where('choice_id', NULL)->paginate(25);
        return view('analytics.others', compact('answers', 'survey'));
    }

    public function opens($survey_id, $id)
    {
    	$survey = Anket::findOrFail($survey_id);
    	$answers = Answer::where('question_id', $id)->where('choice_id', NULL)->paginate(25);
        return view('analytics.opens', compact('answers', 'survey'));
    }
}
