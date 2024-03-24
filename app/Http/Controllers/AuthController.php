<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth; 

class AuthController extends Controller
{
    public function logout()
    {
        Auth::logout();

        return redirect()->route('login');
    }

    public function loginForm()
    {
        return view('auth/login');
    }

    public function login(Request $request)
    {
        $wasLoginSuccessful = Auth::attempt([
            'email' => $request->input('email'), 
            'password' => $request->input('password')
        ]);

        if($wasLoginSuccessful)
        {
            return redirect()->route('profile.index');
        }
        else 
        {
            return redirect()->route('login')->with('error', 'Invalid credentials');
        }
    }
}
