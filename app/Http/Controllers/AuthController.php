<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth; 

class AuthController extends Controller
{
    public function logout()
    {
        $user = Auth::user();
        Auth::logout();

        return redirect()->route('login')
        ->with('success', "You successfully logged out. Please come back soon {$user->name}!");;
    }

    public function loginForm()
    {
        return view('auth/login');
    }

    public function login(Request $request)
    {
        $request->validate([
            'email' => 'required|min:5|email:rfc,dns|max:30', 
            'password' => 'required|max:15|min:4|regex:/^(?=.*[0-9])(?=.*[^a-zA-Z0-9])/'
        ]);

        $wasLoginSuccessful = Auth::attempt([
            'email' => $request->input('email'), 
            'password' => $request->input('password')
        ]);

        if($wasLoginSuccessful)
        {
            return redirect()->route('profile.index')
            ->with('success', "You successfully logged in. Welcome back {$request->input('email')}.");
        }
        else 
        {
            return redirect()->route('login')->with('error', 'Invalid credentials. Please try again.');
        }
    }
}
