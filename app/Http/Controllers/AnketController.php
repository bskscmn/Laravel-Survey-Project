<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Anket;
use App\QuestionType;

class AnketController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    	$ankets = Anket::all();
        return view('admin.ankets', compact('ankets'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $messages = [
            'name.required' => 'Anket alanı zorunludur.',
        ];
        $this->validate($request,[
            'name' => 'required|string|max:255',
        ], $messages);
    
        $anket = Anket::create([
            'name' => $request['name'],
        ]);

        $ankets = Anket::all();
	    return view('admin.ankets', compact('ankets'));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
    	$anket = Anket::findOrFail($id);
    	$questionTypes = QuestionType::all();
        return view('admin.anket', compact('anket', 'questionTypes'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $anket = Anket::findOrFail($request['id']);

        $messages = [
            'name.required' => 'Anket alanı zorunludur.',
        ];
        $this->validate($request,[
            'name' => 'required|string|max:255',
        ], $messages);

        $anket->update($request->all());
       
       $ankets = Anket::all();
	   return view('admin.ankets', compact('ankets'));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $anket = Anket::findOrFail($id);
        $anket->delete();

        return redirect('/ankets')->with('success', 'Silindi.');
    }
}
