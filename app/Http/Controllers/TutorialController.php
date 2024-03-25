<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutorial;
use App\Models\User;
use Auth;

class TutorialController extends Controller
{
    public function home() 
    {
        return view('dj/index', [
            
        ]);
    }

    public function index() 
    {
        $tutorials = Tutorial::with(['user'])
            ->orderBy('created_at', 'DESC')
            ->get();

        return view('dj/tutorials/index', [
            'tutorials' => $tutorials,
        ]);
    }

    public function create() 
    {
        return view('dj/tutorials/create', [

        ]);
    }

    public function store(Request $request) 
    {
        $request->validate([
            'title' => 'required|min:6|max:25', 
            'photo_url' => 'required', 
            'body' => 'required|min:10|max:150', 
            'tips' => 'required|min:4|max:25'
        ]);

        $userId = Auth::user()->id;
        $user = User::find($userId);

        $tutorial = new Tutorial(); 
        $tutorial->title = $request->input('title');
        $tutorial->photo_url = $request->input('photo_url');
        $tutorial->body = $request->input('body');
        $tutorial->tips = $request->input('tips');
        $tutorial->user_id = $userId;
        $tutorial->save();

        return redirect()
            ->route('tutorials.index')
            ->with('success', "{$user->name} successfully created {$tutorial->title}.");
    }

    public function show($tutorialId) 
    {
        $tutorial = Tutorial::with(['user', 'users'])->find($tutorialId);

        return view('dj/tutorials/show', [
            'tutorial' => $tutorial,
        ]);
    }

    public function delete($tutorialId)
    {
        $tutorial = Tutorial::find($tutorialId);

        $tutorial->delete();

        return redirect()
            ->route('tutorials.index')
            ->with('success', "Successfully deleted {$tutorial->title}.");
    }

    public function bookmark($tutorialId)
    {
        $user = Auth::user();

        $tutorial = Tutorial::find($tutorialId);

        $bookmarked = $user->tutorials()
            ->where('tutorial_id', $tutorialId)
            ->get();

        if (count($bookmarked) >= 1) 
        {
            $user->tutorials()->detach($tutorialId);
        } 
        else 
        {
            $user->tutorials()->attach($tutorialId);
        }

        if (count($bookmarked) >= 1)
        {
            return redirect()
                ->route('tutorials.show', ['id' => $tutorialId])
                ->with('success', "Successfully removed bookmark for {$tutorial->title}.");
        }
        else 
        {
            return redirect()
                ->route('tutorials.show', ['id' => $tutorialId])
                ->with('success', "Successfully bookmarked {$tutorial->title}.");
        }
    }
}
