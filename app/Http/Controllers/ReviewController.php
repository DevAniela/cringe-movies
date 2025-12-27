<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Movie;
use App\Models\Review;
use Illuminate\Support\Facades\Auth;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class ReviewController extends Controller
{
    use AuthorizesRequests;

    public function store(Request $request, Movie $movie)
    {
        $validated = $request->validate([
            'cringe_rating' => 'required|integer|min:1|max:10',
            'content' => 'required|string|min:3|max:500',
        ]);

        Review::create([
            'user_id' => Auth::id(),
            'movie_id' => $movie->id,
            'cringe_rating' => $validated['cringe_rating'],
            'content' => $validated['content'],
        ]);

        return redirect()->route('movies.show', $movie)->with('status', 'Review posted.');
    }

    public function destroy(Review $review)
    {
        $this->authorize('delete', $review);
        $review->delete();
        return back()->with('status', 'Review deleted.');
    }
}
