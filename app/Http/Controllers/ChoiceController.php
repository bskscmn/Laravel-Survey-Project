<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Choice;
use App\Question;
use App\QuestionType;

class ChoiceController extends Controller
{
    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, $anketid)
    {
        $messages = [
            'choice.required' => 'Seçenek alanı zorunludur.',
        ];
        $this->validate($request,[
            'choice' => 'required|string|max:255',
        ], $messages);

        $choice = Choice::create([
            'question_id' => $request['question_id'],
            'choice' => $request['choice'],
        ]);

        $questionTypes = QuestionType::all();
        return redirect()->to('/ankets/show/'.$anketid)->with(compact('questionTypes')); 
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $anketid)
    {
        $choice = Choice::findOrFail($request['id']);

        $messages = [
            'choice.required' => 'Seçenek alanı zorunludur.',
        ];
        $this->validate($request,[
            'choice' => 'required|string|max:255',
        ], $messages);

        $choice->update($request->all());
        
        $questionTypes = QuestionType::all();
        return redirect()->to('/ankets/show/'.$anketid)->with(compact('questionTypes')); 
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
        return redirect()->to('/ankets/show/'.$question->anket_id)->with(compact('questionTypes')); 
    }
}
