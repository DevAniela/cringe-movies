<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-600 leading-tight">{{ __('Welcome to Cringe Movies') }}</h2>
            @auth
                <a href="{{ route('movies.create') }}" class="bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-700 hover:to-blue-700 text-white font-bold py-2 px-6 rounded-md text-sm transition shadow-lg">+ Add New Movie</a>
            @endauth
        </div>
    </x-slot>

    <div class="py-12 bg-gray-900 min-h-screen text-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            
            <h3 class="text-2xl font-bold text-transparent bg-clip-text bg-gradient-to-r from-purple-400 to-blue-400 mb-8 px-4">Latest Cringe:</h3>

            @if($movies->isEmpty())
                <p class="px-4 text-gray-500 italic">No movies have been added yet. Be the first to add one!</p>
            @else
                <ul class="space-y-6 px-4">
                    @foreach($movies as $movie)
                        <li class="bg-gray-800 border-l-4 border-purple-500 p-6 rounded-xl shadow-2xl hover:bg-gray-750 transition duration-300">
                            
                        <a href="{{ route('movies.show', $movie) }}" class="group">
                                <h4 class="text-xl font-bold text-blue-400 group-hover:text-purple-400 transition">{{ $movie->title }}
                                    <span class="text-gray-500 font-normal text-sm italic">({{ $movie->release_year }})</span>
                                </h4>
                            </a>

                            <p class="text-sm text-gray-400 mt-2 uppercase tracking-widest">Added by: <span class="text-purple-300">{{ $movie->user->name ?? 'Unknown' }}</span>
                                @if($movie->category)
                                <span class="mx-2 text-gray-600">|</span>
                                Category: <span class="bg-blue-300 text-gray-600">{{ $movie->category->name }}</span>
                                @endif
                            </p>

                            <p class="text-gray-300 mt-4 leading-relaxed">{{ Str::limit($movie->description, 120) }}</p>
                        </li>
                    @endforeach
                </ul>

                <div class="mt-10 px-4">
                    {{ $movies->links() }}
                </div>
                
            @endif

        </div>
    </div>
</x-app-layout>
