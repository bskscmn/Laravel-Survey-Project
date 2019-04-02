<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Survey;
use App\QuestionType;
use App\ScaleType;

class SurveyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$surveys = Survey::all();
        return view('admin.surveys', compact('surveys'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required|string|max:255',
        ]);
    
        $survey = Survey::create([
            'name' => $request['name'],
        ]);

        $surveys = Survey::all();
	    return view('admin.surveys', compact('surveys'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$survey = Survey::findOrFail($id);
        $questionTypes = QuestionType::all();
        $scaleTypes = ScaleType::all();
        return view('admin.survey', compact('survey', 'questionTypes', 'scaleTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $survey = Survey::findOrFail($request['id']);

        $this->validate($request,[
            'name' => 'required|string|max:255',
        ]);

        $survey->update($request->all());
       
       $surveys = Survey::all();
	   return view('admin.surveys', compact('surveys'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $survey = Survey::findOrFail($id);
        $survey->delete();

        return redirect('/surveys')->with('success', 'Silindi.');
    }
}
