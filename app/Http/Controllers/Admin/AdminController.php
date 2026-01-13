<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Movie;
use App\Models\Review;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();

        $stats = [
            'total_movies' => Movie::count(),
            'total_reviews' => Review::count(),
            'total_users' => User::count(),
        ];

        return view('admin.dashboard', compact('users', 'stats'));
    }

    public function destroyUser(User $user)
    {
        if($user->id === auth()->id()) {
            return back()->with('status', 'Error! You are not allowed to delete your own admin account.');
        }

        $user->delete();
        return back()->with('status', 'User successfully deleted.');
    }
}
