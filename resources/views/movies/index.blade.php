<x-app-layout>
    <x-slot name="header">
        <h2>{{ __('Cringe Movies') }}</h2>
    </x-slot>

    <div>
        <h3>Movie List:</h3>

        @if($movies->isEmpty())
            <p>No movies have been added yet. Be the first to add one!</p>
        @else
            <ul>
                @foreach($movies as $movie)
                    <li>
                        <a href="{{ route('movies.show', $movie) }}">
                            <h4>{{ $movie->title }} ({{ $movie->release_year }})</h4>
                        </a>

                        <p>Added by: **{{ $movie->user->name ?? 'Unknown' }}**
                            @if($movie->category)
                                | Category: {{ $movie->category->name }}
                            @endif
                        </p>

                        <p>{{ Str::limit($movie->description, 100) }}</p>
                    </li>
                @endforeach
            </ul>

            <div>
                {{ $movies->links() }}
            </div>
            
        @endif

    </div>
</x-app-layout>