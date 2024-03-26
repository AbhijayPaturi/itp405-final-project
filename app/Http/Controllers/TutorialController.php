<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutorial;
use App\Models\Review;
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
            ->orderBy('updated_at', 'DESC')
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
            'title' => 'required|min:6|max:50', 
            'photo_url' => 'required', 
            'body' => 'required|min:10|max:250', 
            'tips' => 'required|min:4|max:50'
        ]);

        $userId = Auth::user()->id;

        $tutorial = new Tutorial(); 
        $tutorial->title = $request->input('title');
        $tutorial->photo_url = $request->input('photo_url');
        $tutorial->body = $request->input('body');
        $tutorial->tips = $request->input('tips');
        $tutorial->user_id = $userId;
        $tutorial->save();

        $user = $tutorial->user;

        return redirect()
            ->route('tutorials.index')
            ->with('success', "{$user->name} successfully created '{$tutorial->title}'.");
    }

    public function show($tutorialId) 
    {
        $tutorial = Tutorial::with(['user', 'users'])->find($tutorialId);

        $reviews = Review::where('tutorial_id', "=", $tutorialId)->orderBy('updated_at', 'DESC')
            ->with(['tutorial', 'user'])
            ->get();

        $bookmarks = $tutorial->users()
                            ->get();

        return view('dj/tutorials/show', [
            'tutorial' => $tutorial,
            'reviews' => $reviews,
            'bookmarks' => $bookmarks,
        ]);
    }

    public function delete($tutorialId)
    {
        $tutorial = Tutorial::find($tutorialId);

        $tutorial->delete();

        return redirect()
            ->route('tutorials.index')
            ->with('success', "Successfully deleted '{$tutorial->title}'.");
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
                ->with('success', "Successfully removed bookmark for '{$tutorial->title}'.");
        }
        else 
        {
            return redirect()
                ->route('tutorials.show', ['id' => $tutorialId])
                ->with('success', "Successfully bookmarked '{$tutorial->title}'.");
        }
    }

    public function edit ($tutorialId)
    {
        $tutorial = Tutorial::with(['user'])
                    ->find($tutorialId);

        return view('dj/tutorials/edit', [
            'tutorial' => $tutorial,
        ]);
    }

    public function update(Request $request, $tutorialId)
    {
        $request->validate([
            'title' => 'required|min:6|max:50', 
            'photo_url' => 'required', 
            'body' => 'required|min:10|max:250', 
            'tips' => 'required|min:4|max:50'
        ]);

        $tutorial = Tutorial::with(['user'])
                    ->find($tutorialId);
        $tutorial->photo_url = $request->input('photo_url');
        $tutorial->body = $request->input('body');
        $tutorial->tips = $request->input('tips');
        $tutorial->save();

        $user = $tutorial->user;

        return redirect()
            ->route('tutorials.show', ['id' => $tutorialId])
            ->with('success', "{$user->name} successfully updated their tutorial '{$tutorial->title}' that was posted on " . date_format(date_create($tutorial->created_at), 'n/j/Y \a\t g:i A') . ".");
    }
}
