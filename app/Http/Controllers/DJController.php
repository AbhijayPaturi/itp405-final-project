<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class DJController extends Controller
{
    public function index() 
    {
        return view('dj/index', [
            
        ]);
    }
}
