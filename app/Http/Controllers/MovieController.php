<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Movie;
use App\Models\Category;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class MovieController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $movies = Movie::with(['user', 'category'])
                        ->orderBy('created_at', 'desc')
                        ->paginate(10);

        return view('movies.index', ['movies' => $movies,]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = Category::orderBy('name')->get();
        return view('movies.create', compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:movies',
            'release_year' => 'required|integer|min:1900|max:' . date('Y'),
            'category_id' => 'required|exists:categories,id',
            'poster_url' => 'nullable|url',
            'description' => 'required|string|min:10',
        ]);

        $validated['user_id'] = Auth::id();
        $movie = Movie::create($validated);

        return redirect()->route('movies.show', $movie)->with('status', 'Movie added successfully!');
    }

    /**
     * Display the specified resource.
     */
    public function show(Movie $movie)
    {
        $movie->load(['reviews.user']);
        return view('movies.show', compact('movie'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Movie $movie)
    {
        $this->authorize('update', $movie);
        $categories = Category::orderBy('name')->get();
        return view('movies.edit', compact('movie', 'categories'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Movie $movie)
    {
        $this->authorize('update', $movie);

        $validated = $request->validate([
            'title' => 'required|string|max:255|unique:movies,title,' . $movie->id,
            'release_year' => 'required|integer|min:1900|max:' . date('Y'),
            'category_id' => 'required|exists:categories,id',
            'poster_url' => 'nullable|url',
            'description' => 'required|string|min:10',
        ]);

        $movie->update($validated);

        return redirect()->route('movies.show', $movie)->with('success', 'Movie updated.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Movie $movie)
    {
        $this->authorize('delete', $movie);
        $movie->delete();
        return redirect()->route('movies.index')->with('status', 'Movie deleted.');
    }
}
