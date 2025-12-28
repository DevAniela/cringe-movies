<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-600 leading-tight">{{ $movie->title }}</h2>
            <a href="{{ route('movies.index') }}" class="text-purple-400 hover:text-purple-300 transition text-sm font-bold uppercase tracking-widest">← Back to Movie List</a>
        </div>
    </x-slot>
    
    <div class="py-12 bg-gray-900 min-h-screen text-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <div class="bg-gray-800 border-l-4 border-blue-500 p-8 rounded-xl shadow-2xl mb-10">
                <h3 class="text-3xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-blue-400 mb-2">{{ $movie->title }}</h3>

                <p class="text-sm text-gray-400 uppercase tracking-widest mb-6">
                    Year: <span class="text-purple-300">{{ $movie->release_year }}</span> |
                    Category: <span class="text-blue-300">{{ $movie->category->name ?? 'N/A' }}</span> | 
                    Posted by: <span class="text-purple-300">{{ $movie->user->name ?? 'Unknown' }}</span>
                </p>

                <p class="text-lg text-gray-300 leading-relaxed italic border-b border-gray-700 pb-6">
                    {{ $movie->description }}
                </p>

                @auth
                    @can('update', $movie)
                        <div class="mt-6 flex items-baseline gap-7">
                            <a href="{{ route('movies.edit', $movie) }}" class="text-sm font-bold text-blue-400 hover:text-blue-300 transition uppercase tracking-tighter">Edit Movie</a>
                            <form method="POST" action="{{ route('movies.destroy', $movie) }}" onsubmit="return confirm('Are you sure?');">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-sm font-bold text-red-400 hover:text-red-300 transition uppercase tracking-tighter">Delete Movie</button>
                            </form>
                        </div>
                    @endcan
                @endauth
            </div>

            {{-- Review container --}}
            <div class="bg-gray-800 p-8 rounded-2xl shadow-2xl mt-10">
                <h4 class="text-xl font-bold text-blue-400 mb-6 uppercase tracking-widest">
                    Cringe Reviews ({{ $movie->reviews->count() }})
                </h4>

                {{-- List of existing reviews --}}
                <div class="space-y-6 mb-10">
                    @forelse($movie->reviews as $review)
                        <div class="border-l-2 border-gray-700 pl-4 py-2">
                            <div class="flex items-center gap-2 mb-1">
                                <span class="text-yellow-400 font-bold">★ {{ $review->cringe_rating }}/10</span>
                                <span class="text-gray-500 text-xs">- {{ $review->user->name ?? 'Deleted User' }}</span>
                                </div>
                                <p class="text-gray-400 text-sm italic">{{ $review->content }}</p>

                                @auth
                                    @can('delete', $review)
                                        <form method="POST" action="{{ route('reviews.destroy', $review) }}" onsubmit="return confirm('Delete this review?');" class="mt-2">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="text-xs text-gray-600 hover:text-red-400 uppercase font-bold tracking-tighter transition">Delete Review</button>
                                        </form>
                                    @endcan
                                @endauth
                            </div>
                        @empty
                            <p class="text-gray-500 italic">No one has rated the cringe yet... Be the first one!</p>    
                        @endforelse
                    </div>

                    <hr class="border-gray-700 mb-8">
                    
                    {{-- Form for adding ratings and reviews (only for logged-in users) --}}
                    @auth
                    <h5 class="text-purple-400 font-bold mb-4 uppercase text-sm tracking-widest">Add Your Rating</h5>
                    <form method="POST" action="{{ route('reviews.store', $movie) }}" class="bg-gray-900 p-6 rounded-lg border border-gray-700">
                        @csrf
                        <div class="grid grid-cols-1 md:grid-cols-4 gap-4 mb-4">
                            <div class="md:col-span-1">
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Cringe Score (1-10):</label>
                                <input type="number" name="cringe_rating" min="1" max="10" required
                                class="w-full bg-gray-800 border-gray-700 text-purple-400 rounded-md focus:ring-purple-500 focus:border-purple-500">
                            </div>
                            
                            <div class="md:col-span-3">
                                <label class="block text-xs font-bold text-gray-500 uppercase mb-1">Your Review:</label>
                                <textarea name="content" rows="1" required
                                class="w-full bg-gray-800 border-gray-700 text-gray-200 rounded-md focus:ring-blue-500 focus:border-blue-500"></textarea>
                            </div>
                        </div>
                        <button type="submit" class="w-full bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white font-bold py-2 rounded-md transition shadow-lg uppercase text-xs tracking-widest">Post Cringe Review</button>
                    </form>
                @else
                    <div class="text-center py-4 bg-gray-900 rounded-lg border border-dashed border-gray-700">
                        <p class="text-gray-500 italic">
                            Want to join the cringe? <a href="{{ route('login') }}" class="text-blue-400 hover:underline font-bold">Log in</a> to leave a review.
                        </p>
                    </div>
                @endauth
        </div>
    </div>
</x-app-layout>