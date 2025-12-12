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