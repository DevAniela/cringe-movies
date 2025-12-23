<x-app-layout>
    <x-slot name="header">
        <h2>{{ __('Edit Movie: ') . $movie->title }}</h2>
    </x-slot>

    <div>
        <a href="{{ route('movies.show', $movie) }}">← Back to Movie Detail</a>
        
        <h3>Edit Movie Details</h3>

        <form method="POST" action="{{ route('movies.update', $movie) }}">
            @csrf
            @method('PATCH')

            <div>
                <label for="title">Title:</label>
                <input id="title" name="title" type="text" value="{{ old('title', $movie->title) }}" required />
                @error('title')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="release_year">Release Year</label>
                <input id="release_year" name="release_year" type="number" value="{{ old('release_year', $movie->release_year) }}" required />
                @error('release_year')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="category_id">Category:</label>
                <select id="category_id" name="category_id" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id', $movie->category_id) == $category->id ? 'selected' : '' }}>
                            {{ $category->name }}
                        </option>
                    @endforeach
                </select>
                @error('category_id')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="poster_url">Poster URL:</label>
                <input id="poster_url" name="poster_url" type="url" value="{{ old('poster_url', $movie->poster_url) }}" />
                @error('poster_url')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="description">Description</label>
                <textarea id="description" name="description" rows="4" required>{{ old('description', $movie->description) }}</textarea>
                @error('description')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit">Update Movie</button>
            </div>

        </form>

    </div>
</x-app-layout>