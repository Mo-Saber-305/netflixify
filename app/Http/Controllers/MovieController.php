<?php

namespace App\Http\Controllers;

use App\Models\Movie;

class MovieController extends Controller
{
    public function show($id)
    {
        $movie = Movie::findOrFail($id);
        $movies = Movie::all();
        return view('movies.show', compact('movies', 'movie'));
    }
}
