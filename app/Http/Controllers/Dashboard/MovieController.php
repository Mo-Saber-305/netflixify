<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Jobs\StreamMovie;
use App\Models\Category;
use App\Models\Movie;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class MovieController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create_movies')->only(['create', 'store']);
        $this->middleware('permission:read_movies')->only(['index']);
        $this->middleware('permission:update_movies')->only(['edit', 'update']);
        $this->middleware('permission:delete_movies')->only(['destroy']);
    }//end of construct

    public function index(Request $request)
    {
        if ($request->category == 'all') {
            $movies = Movie::where('percent', 100)->with('categories')->get();
        } else {
            $movies = Movie::where('percent', 100)->when($request->category, function ($query) use ($request) {
                $query->whereHas('categories', function ($que) use ($request) {
                    $que->whereIn('category_id', (array)$request->category);
                });
            })->with('categories')->get();
        }

        $categories = Category::all();

        return view('dashboard.pages.movies.index', compact('movies', 'categories'));
    }//end of index

    public function create()
    {
        $categories = Category::all();
        $movie = new Movie();
        $movie->save();
        return view('dashboard.pages.movies.create', compact('movie', 'categories'));
    }//end of create

    public function store(Request $request)
    {
        $movie = Movie::findOrFail($request->movie_id);

        $movie->update([
            'name' => $request->movie_name,
            'path' => $request->file('movie')->store('movies'),
        ]);

        // the job in background
        dispatch(new StreamMovie($movie));

        return $movie;
    }//end of store

    public function show(Movie $movie)
    {
        return $movie;
    }

    public function edit(Movie $movie)
    {
        $categories = Category::all();
        return view('dashboard.pages.movies.edit', compact('movie', 'categories'));
    }//end of edit

    public function update(Request $request, Movie $movie)
    {
//        dd($request->all());
        if ($request->type == 'publish') {
            //publish
            $request->validate([
                'name' => ['required', 'unique:movies,name, ' . $movie->id],
                'description' => ['required'],
                'image' => ['required', 'image'],
                'poster' => ['required', 'image'],
                'categories' => ['required', 'array'],
                'year' => ['required'],
                'rate' => ['required'],
            ]);
        } else {
            //update
            $request->validate([
                'name' => ['required', 'unique:movies,name, ' . $movie->id],
                'description' => ['required'],
                'image' => ['sometimes', 'nullable', 'image'],
                'poster' => ['sometimes', 'nullable', 'image'],
                'categories' => ['required', 'array'],
                'year' => ['required'],
                'rate' => ['required'],
            ]);
        }

        $data = $request->except(['poster', 'image', 'categories', 'type']);

        if ($request->poster) {
            $this->removePrevious('poster', $movie);
            $name = $request->poster->hashName();
            $poster = Image::make($request->poster)->resize(255, 378)->encode('jpg');

            Storage::disk('local')->put('public/images/' . $name, (string)$poster, 'public');

            $data['poster'] = $name;
        }

        if ($request->image) {
            $this->removePrevious('image', $movie);
            $name = $request->image->hashName();
            $image = Image::make($request->image)->encode('jpg', 50);

            Storage::disk('local')->put('public/images/' . $name, (string)$image, 'public');

            $data['image'] = $name;
        }


        $movie->update($data);

        $movie->categories()->sync($request->categories);

        alert()->success('Movies Updated Successfully');

        return redirect()->route('dashboard.movies.index');
    }//end of update


    public function destroy(Request $request)
    {
        $movie = Movie::findOrFail($request['id']);

        Storage::disk('local')->delete('public/images/' . $movie->poster);
        Storage::disk('local')->delete('public/images/' . $movie->image);

        Storage::disk('local')->delete('movies/' . $movie->path);
        Storage::disk('local')->deleteDirectory('public/movies/' . $movie->id);

        $movie->delete();

        alert()->error('Movies Deleted Successfully');

        return redirect()->route('dashboard.movies.index');
    }//end of destroy

    private function removePrevious($image_type, $movie)
    {
        if ($image_type == 'poster') {
            if ($movie->poster != null) {
                Storage::disk('local')->delete('public/images/' . $movie->poster);
            }
        } else {
            if ($movie->image != null) {
                Storage::disk('local')->delete('public/images/' . $movie->image);
            }
        }
    }
}
