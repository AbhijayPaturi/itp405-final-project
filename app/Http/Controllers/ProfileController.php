<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutorial;
use App\Models\Review;
use Auth; 

class ProfileController extends Controller
{
    public function index() 
    {
        $user = Auth::user(); 

        $tutorials = Tutorial::where('user_id', '=', $user->id)
                        ->get();

        $reviews = Review::where('user_id', '=', $user->id)
                    ->get();

        return view('profile/index', [
            'user' => $user,
            'tutorials' => $tutorials, 
            'reviews' => $reviews
        ]);
    }
}
