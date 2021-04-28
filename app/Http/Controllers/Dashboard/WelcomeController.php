<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Movie;
use App\User;

class WelcomeController extends Controller
{
    public function index()
    {
        $usersCount = User::whereRole('user')->count();
        $moviesCount = Movie::where('percent', 100)->count();
        $categoriesCount = Category::count();
        return view('dashboard.pages.welcome', compact('usersCount', 'moviesCount', 'categoriesCount'));
    }
}
