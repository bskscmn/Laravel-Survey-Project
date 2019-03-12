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
            'soru.required' => 'Soru alanı zorunludur.',
            'questionType.required' => 'Yetki seçiniz.',
        ];
        $this->validate($request,[
            'soru' => 'required|string|max:255',
            'questionType' => 'required|integer',
        ], $messages);

        $question = Question::create([
            'anket_id' => $anketid,
            'question_type_id' => $request['questionType'],
            'soru' => $request['soru'],
        ]);


        $anket = Question::findOrFail($anketid);
        $questionTypes = QuestionType::all();
        return redirect()->to('/ankets/show/'.$anketid)->with(compact('questionTypes')); 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
