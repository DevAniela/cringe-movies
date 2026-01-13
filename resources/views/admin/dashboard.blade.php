<x-app-layout>
    <x-slot  name="header">
        <h2>Admin Dashboard</h2>
    </x-slot>

    <div>
        <div>
            <div>
                <div>
                    <p>Total Movies</p>
                    <p>{{ $moviesCount }}</p>
                </div>

                <div>
                    <p>Total Users</p>
                    <p>{{ $users->count() }}</p>
                </div>
            </div>

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

        </div>
    </div>

</x-app-layout>
