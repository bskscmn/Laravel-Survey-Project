<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anket;

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
     	return $request->all();
       
    }
}
