<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutorial;
use App\Models\User;
use Auth;

class BookmarkController extends Controller
{
    public function index() 
    {
        $user = Auth::user();

        $bookmarks = $user->tutorials()->with(['user'])
            ->get();

        return view('dj/bookmarks/index', [
            'bookmarks' => $bookmarks,
        ]);
    }

    public function unbookmark($tutorialId) 
    {
        $user = Auth::user();

        $tutorial = Tutorial::find($tutorialId);

        $user->tutorials()->detach($tutorialId);

        return redirect()
            ->route('bookmarks.index')
            ->with('success', "Successfully unbookmarked '{$tutorial->title}'. Removed from bookmarks.");
    }
}
