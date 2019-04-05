<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Choice;
use App\Question;
use App\ScaleQuestion;
use App\QuestionType;
use App\Scale;

class ChoiceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $surveyid)
    {

        $this->validate($request,[
            'choice' => 'required|string|max:255',
        ]);

        $choice = Choice::create([
            'question_id' => $request['question_id'],
            'choice' => $request['choice'],
        ]);

        $questionTypes = QuestionType::all();
        return redirect()->to('/surveys/show/'.$surveyid)->with(compact('questionTypes'));
    }

     /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeScaleQuestion(Request $request, $surveyid)
    {
        $this->validate($request,[
            'questionNumber' => 'required|integer',
            'soru' => 'required|string|max:255',
        ]);

        $scaleQuestion = ScaleQuestion::create([
            'survey_id' => $surveyid,
            'question_id' => $request['question_id'],
            'question_number' => $request['questionNumber'],
            'soru' => $request['soru'],
        ]);

        $questionTypes = QuestionType::all();
        return redirect()->to('/surveys/show/'.$surveyid)->with(compact('questionTypes'));
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $surveyid)
    {
        $choice = Choice::findOrFail($request['id']);

        $this->validate($request,[
            'choice' => 'required|string|max:255',
        ]);

        $choice->update($request->all());
        
        $questionTypes = QuestionType::all();
        return redirect()->to('/surveys/show/'.$surveyid)->with(compact('questionTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function updateScaleQuestion(Request $request, $surveyid)
    {
        $scaleQuestion = ScaleQuestion::findOrFail($request['id']);

        $messages = [
            'question_number.required' => 'Soru no alanı zorunludur.',
            'soru.required' => 'Soru alanı zorunludur.',
        ];
        $this->validate($request,[
            'question_number' => 'required|integer',
            'soru' => 'required|string|max:255',
        ], $messages);

        $scaleQuestion->update($request->all());

        $questionTypes = QuestionType::all();
        return redirect()->to('/surveys/show/'.$surveyid)->with(compact('questionTypes'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $choice = Choice::findOrFail($id);
        $question = Question::findOrFail($choice->question_id);

        $choice->delete();

        $questionTypes = QuestionType::all();
        return redirect()->to('/surveys/show/'.$question->survey_id)->with(compact('questionTypes'));
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroyScaleQuestion($id)
    {
        $scaleQuestion = ScaleQuestion::findOrFail($id);
        $question = Question::findOrFail($scaleQuestion->question_id);

        $scaleQuestion->delete();

        $questionTypes = QuestionType::all();
        return redirect()->to('/surveys/show/'.$question->survey_id)->with(compact('questionTypes'));
    }
}
