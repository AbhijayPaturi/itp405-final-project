<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class TutorialController extends Controller
{
    public function home() 
    {
        return view('dj/index', [
            
        ]);
    }

    public function index() 
    {
        return view('dj/tutorials/index', [

        ]);
    }
}
