<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Anket;

class WelcomeController extends Controller
{
    public function index()
    {
        $surveys = Anket::all();
	    return view('welcome', ['surveys' => $surveys]);
    }
}
