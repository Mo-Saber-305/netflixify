<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Movie;

class WelcomeController extends Controller
{
    public function index()
    {
        $latest_movies = Movie::where('percent', 100)->latest()->limit(3)->get();

        $categories = Category::with('movies')->get();

        return view('welcome', compact('latest_movies', 'categories'));
    }
}
