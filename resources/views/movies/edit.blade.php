<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-400 leading-tight">{{ __('Edit Movie: ') . $movie->title }}</h2>
            <a href="{{ route('movies.show', $movie) }}" class="text-purple-400 hover:text-purple-300 transition text-sm font-bold uppercase tracking-widest">← Back to Movie Page</a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-900 min-h-screen text-gray-100">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-gray-800 border-l-4 border-purple-500 p-8 rounded-xl shadow-2xl">
                    <h3 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-blue-400 mb-6 uppercase tracking-widest">Edit Movie Details</h3>

                    <form method="POST" action="{{ route('movies.update', $movie) }}" class="space-y-6">
                    @csrf
                    @method('PATCH')
                    <div>
                        <label for="title" class="block text-xs font-bold text-gray-500 uppercase mb-2 tracking-tighter">Title:</label>
                        <input id="title" name="title" type="text" value="{{ old('title', $movie->title) }}" required class="w-full bg-gray-900 border-gray-700 text-gray-100 rounded-md focus:ring-purple-500 focus:border-purple-500 p-3 transition" />
                        @error('title')
                            <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="grid grid-cols-1 md:grid-cols-2 gap-6">
                        <div>
                            <label for="release_year" class="block text-xs font-bold text-gray-500 uppercase mb-2 tracking-tighter">Release Year</label>
                            <input id="release_year" name="release_year" type="number" min="1900" max="{{ date('Y') + 5 }}" value="{{ old('release_year', $movie->release_year) }}" required class="w-full bg-gray-900 border-gray-700 text-purple-400 rounded-md focus:ring-purple-500 focus:border-purple-500 p-3 transition" />
                            @error('release_year')
                                <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p>
                            @enderror
                        </div>

                        <div>
                            <label for="category_id" class="block text-xs font-bold text-gray-500 uppercase mb-2 tracking-tighter">Category:</label>
                            <select id="category_id" name="category_id" required class="w-full bg-gray-900 border-gray-700 text-blue-400 rounded-md focus:ring-blue-500 focus:border-blue-500 p-3 transition">
                                <option value="" disabled selected>Select Category</option>
                                @foreach($categories as $category)
                                    <option value="{{ $category->id }}" {{ old('category_id', $movie->category_id) == $category->id ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('category_id')
                                <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label for="description" class="block text-xs font-bold text-gray-500 uppercase mb-2 tracking-tighter">Description</label>
                        <textarea id="description" name="description" rows="4" required class="w-full bg-gray-900 border-gray-700 text-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 p-3 transition">{{ old('description', $movie->description) }}</textarea>
                        @error('description')
                            <p class="text-red-500 text-xs mt-1 italic">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between pt-4">
                        <button type="submit" class="bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white font-bold py-3 px-10 rounded-md transition shadow-lg uppercase text-sm tracking-widest">Update Movie</button>
                        <a href="{{ route('movies.show', $movie) }}" class="text-sm font-bold text-gray-500 hover:text-gray-300 transition uppercase tracking-widest">Cancel</a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>