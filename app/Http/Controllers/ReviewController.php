<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tutorial;
use App\Models\Review;
use App\Models\User;
use Auth; 

class ReviewController extends Controller
{
    public function create($tutorialId) 
    {
        $tutorials = Tutorial::orderBy('created_at', 'DESC')
            ->get();

        $tutorial = Tutorial::find($tutorialId);

        return view('dj/reviews/create', [
            'preSelectedTutorial' => $tutorial,
            'tutorials' => $tutorials,
        ]);
    }

    public function store(Request $request) 
    {
        $request->validate([
            'tutorial' => 'required|exists:App\Models\Tutorial,id', 
            'body' => 'required|min:10|max:200', 
            'rating' => 'required|numeric|min:1|max:5', 
        ]);

        $user = Auth::user();
        $userId = $user->id;
        
        $review = new Review(); 
        $review->tutorial_id = $request->input('tutorial');
        $review->body = $request->input('body');
        $review->rating = $request->input('rating');
        $review->user_id = $userId;
        $review->save();

        $tutorial = $review->tutorial;

        return redirect()
            ->route('tutorials.show', ['id' => $request->input('tutorial')])
            ->with('success', "{$user->name} successfully commented on '{$tutorial->title}' at " . date_format(date_create($review->created_at), 'n/j/Y \a\t g:i A') . ".");
    }

    public function edit ($reviewId)
    {
        $review = Review::with(['tutorial', 'user'])
                    ->find($reviewId);

        $tutorials = Tutorial::orderBy('created_at', 'DESC')
            ->get();

        return view('dj/reviews/edit', [
            'review' => $review,
            'tutorials' => $tutorials
        ]);
    }

    public function update(Request $request, $reviewId)
    {
        $request->validate([
            'tutorial' => 'required|exists:App\Models\Tutorial,id', 
            'body' => 'required|min:10|max:200', 
            'rating' => 'required|numeric|min:1|max:5', 
        ]);

        $review = Review::with(['tutorial', 'user'])
                    ->find($reviewId);
        $review->tutorial_id = $request->input('tutorial');
        $review->body = $request->input('body');
        $review->rating = $request->input('rating');
        $review->save();

        $user = $review->user;
        $tutorial = $review->tutorial;

        return redirect()
            ->route('tutorials.show', ['id' => $request->input('tutorial')])
            ->with('success', "{$user->name} successfully updated their comment on '{$tutorial->title}' that was posted on " . date_format(date_create($review->created_at), 'n/j/Y \a\t g:i A') . ".");
    }

    public function delete($reviewId)
    {
        $review = Review::with(['tutorial', 'user'])
            ->find($reviewId);
        $tutorial = $review->tutorial;
        $user = $review->user;
        $review->delete();
        
        return redirect()
            ->route('tutorials.show', ['id' => $review->tutorial->id])
            ->with('success', "{$user->name} successfully deleted their comment on '{$tutorial->title}' that was posted on " . date_format(date_create($review->created_at), 'n/j/Y \a\t g:i A') . ".");
    }
}
