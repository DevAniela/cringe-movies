<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Models\Movie;
use App\Models\Review;
use App\Models\Category;

class AdminController extends Controller
{
    public function index()
    {
        $users = User::all();

        $categories = Category::all();

        $stats = [
            'total_movies' => Movie::count(),
            'total_reviews' => Review::count(),
            'total_users' => User::count(),
        ];

        return view('admin.dashboard', compact('users', 'stats', 'categories'));
    }
    
    public function destroyUser(User $user)
    {
        if($user->id === auth()->id()) {
            return back()->with('status', 'Error! You are not allowed to delete your own admin account.');
            }
            
        $user->delete();
            return back()->with('status', 'User successfully deleted.');
    }

    public function storeCategory(\Illuminate\Http\Request $request)
        {
            $request->validate(['name' => 'required|unique:categories|max:255']);
            Category::create($request->all());
            return back()->with('status', 'Category created successfully.');
        }
        
        public function destroyCategory(Category $category)
        {
            $category->delete();
            return back()->with('status', 'Category deleted successfully.');
        }
}