<x-app-layout>
    <x-slot  name="header">
        <h2>Admin Dashboard</h2>
    </x-slot>

    <div>
        <div>
            <div>
                <div>
                    <p>Total Movies</p>
                    <p>{{ $stats['total_movies'] }}</p>
                </div>

                <div>
                    <p>Total Users</p>
                    <p>{{ $stats['total_users'] }}</p>
                </div>
            </div>

            {{-- USERS TABLE --}}
            <div>
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Status</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                        <tr>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>
                                <span>
                                    {{ $user->is_admin ? 'Admin' : 'User' }}
                                </span>
                            </td>
                            <td>
                                @if($user->id !== auth()->id())
                                <form method="POST" action="{{ route('admin.users.destroy', $user) }}" onsubmit="return confirm('Delete this user?');">
                                    @csrf @method('DELETE')
                                    <button>Delete</button>
                                </form>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            {{-- CATEGORIES --}}
            <div>
                <h3>Manage Categories</h3>
                
                {{-- Add Form --}}
                <form method="POST" action="{{ route('admin.categories.store') }}">
                    @csrf
                    <input type="text" name="name" placeholder="New category name" required>
                    <button type="submit">Add Category</button>
                </form>

                {{-- Category List --}}
                <table>
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($categories as $category)
                        <tr>
                            <td>{{ $category->name }}</td>
                            <td>
                                <form method="POST" action="{{ route('admin.categories.destroy', $category) }}" onsubmit="return confirm('Delete category?');">
                                    @csrf @method('DELETE')
                                    <button>Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>

</x-app-layout>
