<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth; 

class RegistrationController extends Controller
{
    public function index() 
    {
        return view('registration/index', [

        ]);
    }

    public function register(Request $request) 
    {
        $request->validate([
            'name' => 'required|min:5|max:30|regex:/\s/',
            'email' => 'required|min:5|email:rfc,dns|max:30', 
            'password' => 'required|max:15|min:4|regex:/^(?=.*[0-9])(?=.*[^a-zA-Z0-9])/'
        ]);

        $user = new User();
        $user->name = $request->input("name");
        $user->email = $request->input('email');
        $user->password = Hash::make($request->input('password'));
        $user->save();

        Auth::login($user);

        return redirect()->route('profile.index')
        ->with('success', "You successfully registered an account. Your username is {$user->email}.");
    }
}
