<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Survey;

class WelcomeController extends Controller
{
    public function index()
    {
        $surveys = Survey::all();
	    return view('welcome', ['surveys' => $surveys]);
    }
}
