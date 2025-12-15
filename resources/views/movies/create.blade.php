<x-app-layout>
    <x-slot name="header">
        <h2>
            {{ __('Add a New Cringe Movie') }}
        </h2>
    </x-slot>

    <div>
        <a href="{{ route('movies.index') }}">← Back to Movie List</a>

        <h3>Submit New Movie</h3>

        <form method="POST" action="{{ route('movies.store') }}">
            @csrf
            <div>
                <label for="title">Title:</label>
                <input id="title" name="title" type="text" value="{{ old('title') }}" required />
                @error('title')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="release_year">Release Year</label>
                <input id="release_year" name="release_year" type="number" value="{{ old('release_year') }}" required />
                @error('release_year')
                    <p>{{ $message}}</p>
                @enderror
            </div>

            <div>
                <label for="category_id">Category:</label>
                <select id="category_id" name="category_id" required>
                    <option value="">Select Category</option>
                    @foreach($categories as $category)
                        <option value="{{ $category->id }}" {{ old('category_id') == $category->id ? 'selected' : '' }}>{{ $category->name }}</option>
                    @endforeach
                </select>
                @error('category_id')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="poster_url">Poster URL:</label>
                <input id="poster_url" name="poster_url" type="url" value="{{ old('poster_url') }}" />
                @error('poster_url')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <label for="decription">Description</label>
                <textarea id="description" name="description" rows="4" required>{{ old('description') }}</textarea>
                @error('description')
                    <p>{{ $message }}</p>
                @enderror
            </div>

            <div>
                <button type="submit">Submit Movie</button>
            </div>
        </form>
    </div>
</x-app-layout>