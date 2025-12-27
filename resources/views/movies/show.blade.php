<x-app-layout>
    <x-slot name="header">
        <h2>{{ $movie->title }} ({{ $movie->release_year }})</h2>
    </x-slot>
    <div>
        <a href="{{ route('movies.index') }}">← Back to Movie List</a>
        
        <h3>{{ $movie->title }}</h3>

        <p>
            **Release Year:** {{ $movie->release_year }} |
            **Category:** {{ $movie->category->name ?? 'N/A' }} | 
            **Added by:** {{ $movie->user->name ?? 'Unknown' }}
        </p>

        <p>
            {{ $movie->description }}
        </p>

        @auth
            @can('update', $movie)
                <div>
                    <hr>
                    <a href="{{ route('movies.edit', $movie) }}">Edit Movie</a>
                    <form method="POST" action="{{ route('movies.destroy', $movie) }}" onsubmit="return confirm('Are you sure?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit">Delete Movie</button>
                    </form>
                </div>
            @endcan
        @endauth

        <hr>
            @auth
                <h4>Add Your Very Own Cringe Rating</h4>
                <form method="POST" action="{{ route('reviews.store', $movie) }}">
                    @csrf
                    <div>
                        <label for="cringe_rating">Rating (1-10):</label>
                        <input type="number" name="cringe_rating" id="cringe_rating" min="1" max="10" required>
                    </div>

                    <div>
                        <label for="content">Your Review:</label>
                        <textarea name="content" id="content" rows="3" required></textarea>
                    </div>

                    <button type="submit">Submit Review</button>
                </form>

                @else
                    <p>
                        <a href="{{ route('login') }}">Log in</a> to leave a review.
                    </p>
            @endauth
        </hr>

        <h4>
            Cringe Ratings ({{ $movie->reviews->count() }})
        </h4>

        @if($movie->reviews->count())
            <ul>
                @foreach($movie->reviews as $review)
                    <li>
                        <p>**Rating** {{ $review->cringe_rating }}/10</p>
                        <p>{{ $review->content }}</p>
                        <p>- {{ $review->user->name ?? 'Deleted User' }}</p>
                    </li>
                @endforeach    
            </ul>
        @else
            <p>No ratings yet. Be the first to give a cringe score!</p>
        @endif
    </div>
</x-app-layout>