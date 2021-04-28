<?php

namespace App\Http\Controllers\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
    public function __construct()
    {
        $this->middleware('permission:create_categories')->only(['create']);
        $this->middleware('permission:read_categories')->only(['index']);
        $this->middleware('permission:update_categories')->only(['edit']);
        $this->middleware('permission:delete_categories')->only(['destroy']);
    }//end of construct

    public function index()
    {
        $categories = Category::withCount('movies')->get();
        return view('dashboard.pages.categories.index', compact('categories'));
    }//end of index

    public function create()
    {
        return view('dashboard.pages.categories.create');
    }//end of create

    public function store(Request $request)
    {
        $request->validate([
            'name' => ['required', 'unique:categories,name']
        ]);

        Category::create([
            'name' => $request['name']
        ]);

        alert()->success('Categories Added Successfully');

        return redirect()->route('dashboard.categories.index');
    }//end of store

    public function edit(Category $category)
    {
        return view('dashboard.pages.categories.edit', compact('category'));
    }//end of edit


    public function update(Request $request, Category $category)
    {
        $request->validate([
            'name' => ['required', 'unique:categories,name, ' . $category->id]
        ]);

        $category->update([
            'name' => $request['name']
        ]);

        alert()->success('Categories Updated Successfully');

        return redirect()->route('dashboard.categories.index');
    }//end of update


    public function destroy(Request $request)
    {
        $category = Category::findOrFail($request['id']);

        $category->delete();

        alert()->error('Categories Deleted Successfully');

        return redirect()->route('dashboard.categories.index');
    }//end of destroy
}
