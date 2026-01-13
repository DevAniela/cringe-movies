<x-app-layout>
    <x-slot  name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-purple-400 leading-tight">Admin Dashboard</h2>
            <a href="{{ route('movies.index') }}" class="text-purple-400 hover:text-purple-300 transition text-sm font-bold uppercase tracking-widest">← Back to Movie List</a>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-900 min-h-screen text-gray-100">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">

            {{-- STATS CARDS --}}
            <div class="flex flex-row gap-6 mb-12">
                <div class="bg-gray-800 p-6 rounded-xl border-l-4 border-blue-500 shadow-lg inline-block w-auto">
                    <p class="text-gray-400 uppercase text-xs font-bold tracking-widest">Total Movies</p>
                    <p class="text-3xl font-bold">{{ $stats['total_movies'] }}</p>
                </div>

                <div class="bg-gray-800 p-6 rounded-xl border-l-4 border-purple-500 shadow-lg inline-block w-auto">
                    <p class="text-gray-400 uppercase text-xs font-bold tracking-widest">Total Users</p>
                    <p class="text-3xl font-bold">{{ $stats['total_users'] }}</p>
                </div>
            </div>

            <div style="height: 30px;"></div>

            {{-- USERS TABLE --}}
            <div class="bg-gray-800 rounded-xl shadow-2xl overflow-hidden border border-gray-700 mb-16">
                <table class="w-full text-left border-collapse">
                    <thead class="bg-gray-700">
                        <tr>
                            <th style="text-align: left !important;" class="p-4 text-xs font-bold uppercase text-gray-400">Name</th>
                            <th style="text-align: left !important;" class="p-4 text-xs font-bold uppercase text-gray-400">Email</th>
                            <th style="text-align: left !important;" class="p-4 text-xs font-bold uppercase text-gray-400">Status</th>
                            <th style="text-align: right !important;" class="p-4 text-xs font-bold uppercase text-gray-400">Actions</th>
                        </tr>
                    </thead>
                    <tbody class="divide-y divide-gray-700">
                        @foreach($users as $user)
                        <tr class="hover:bg-gray-750 transition">
                            <td class="p-4 text-sm text-gray-400 text-left">{{ $user->name }}</td>
                            <td class="p-4 text-sm text-gray-400">{{ $user->email }}</td>
                            <td class="p-4">
                                <span class="px-2 py-1 text-xs rounded {{ $user->is_admin ? 'bg-purple-900 text-purple-200' : 'bg-blue-900 text-blue-200' }}">
                                    {{ $user->is_admin ? 'Admin' : 'User' }}
                                </span>
                            </td>
                            <td class="p-4 text-right">
                                @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Delete this user?');">
                                    @csrf @method('DELETE')
                                    <button class="text-red-400 hover:text-red-300 text-xs font-bold uppercase transition">Delete</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <div style="height: 30px;"></div>

            {{-- CATEGORIES --}}
            <div class="grid grid-cols-1 lg:grid-cols-3 gap-8">

                {{-- Category List --}}
                <div class="lg:col-span-2">
                    <div class="bg-gray-800 rounded-xl shadow-2xl overflow-hidden border border-gray-700">
                        <table class="w-full text-left border-collapse">
                            <thead class="bg-gray-700">
                                <tr>
                                    <th style="text-align: left !important;" class="p-4 text-xs font-bold uppercase text-gray-400 text-left">Category Name</th>
                                    <th class="p-4 text-xs font-bold uppercase text-gray-400 text-right">Actions</th>
                                </tr>
                            </thead>
                            <tbody class="divide-y divide-gray-700">
                                @foreach($categories as $category)
                                <tr class="hover:bg-gray-750 transition">
                                    <td class="p-4 text-sm font-medium text-gray-200 text-left">{{ $category->name }}</td>
                                    <td class="p-4 text-right">
                                        <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Delete category?');">
                                            @csrf @method('DELETE')
                                            <button class="text-red-400 hover:text-red-300 text-xs font-bold uppercase tracking-tighter transition">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

                {{-- Add Category Form --}}
                <div class="lg:col-span-1">
                    <div class="bg-gray-800 p-6 rounded-xl shadow-lg border border-gray-700">
                        <h3 class="text-lg font-bold text-purple-400 mb-4 uppercase tracking-wider">New Category</h3>
                        
                        <form method="POST" action="{{ route('admin.categories.store') }}" class="space-y-4">
                            @csrf
                            <div>
                                <input type="text" name="name" class="w-full bg-gray-900 border-gray-700 text-gray-100 rounded-lg focus:ring-purple-500 focus:border-purple-500" placeholder="e.g. Sci-Fi, Horror..." required>
                            </div>
                            <button type="submit" 
                                class="w-full bg-gradient-to-r from-purple-600 to-blue-600 hover:from-purple-500 hover:to-blue-500 text-white font-bold py-2 px-4 rounded-lg transition duration-300 shadow-md">+ Add Category</button>
                        </form>
                    </div>
                </div>
                
            </div>

        </div>
    </div>

</x-app-layout>
