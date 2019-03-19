<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Question;
use App\QuestionType;

class QuestionController extends Controller
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
            'questionNumber.required' => 'Soru no alanı zorunludur.',
            'soru.required' => 'Soru alanı zorunludur.',
            'questionType.required' => 'Soru tipi seçiniz.',
        ];
        $this->validate($request,[
            'questionNumber' => 'required|integer',
            'soru' => 'required|string|max:255',
            'questionType' => 'required|integer',
        ], $messages);

        $question = Question::create([
            'anket_id' => $anketid,
            'question_type_id' => $request['questionType'],
            'question_number' => $request['questionNumber'],
            'soru' => $request['soru'],
        ]);
        if(isset($request['scaleType'])){
            $question->scale_type = $request['scaleType'];
            $question->save();
        }

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
        $question = Question::findOrFail($request['id']);

        $messages = [
            'question_number.required' => 'Soru no alanı zorunludur.',
            'soru.required' => 'Soru alanı zorunludur.',
            'question_type_id.required' => 'Soru tipi seçiniz.',
        ];
        $this->validate($request,[
            'question_number' => 'required|integer',
            'soru' => 'required|string|max:255',
            'question_type_id' => 'required|integer',
            'scale_type_id' => 'sometimes|required|integer',
        ], $messages);

        $question->update($request->all());
        
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
        $question = Question::findOrFail($id);
        $anketid = $question->anket_id;
        $question->delete();

        $questionTypes = QuestionType::all();
        return redirect()->to('/ankets/show/'.$anketid)->with(compact('questionTypes')); 
    }
    
}
