<?php

namespace App\Http\Controllers\Backend;

use App\Models\Category;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Intervention\Image\Facades\Image;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = Category::select('id', 'name', 'image', 'slug', 'status', 'parent_id')->orderBy('id', 'desc')->paginate(20);
        $trashcategories = Category::select('id', 'name', 'image', 'slug', 'status', 'parent_id')->onlyTrashed()->orderBy('id', 'desc')->paginate(20);
        return view('backend.category.index', compact('categories', 'trashcategories'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $request->validate([
            "name" => 'required|unique:categories,name',
            "parent" => 'nullable|integer',
            "description" => 'nullable|max:400',
            "image" => 'nullable|mimes:png,jpg,jpeg|max:300',
        ]);

        $image_name = 'category.jpg';

        if ($request->file('image')) {
            $image_name = Str::uuid() . '.' . $request->file('image')->extension();
            Image::make($request->file('image'))->crop(200, 256)->save(public_path('storage/category/' . $image_name));
        }

        Category::create([
            "name" => $request->name,
            "slug" => Str::slug($request->name),
            "parent" => $request->parent,
            "description" => $request->description,
            "image" => $image_name,
        ]);
        return back()->with('success', 'Cateogry Create Successfull!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function show(Category $category)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function edit(Category $category)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Category $category)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function destroy(Category $category)
    {
        $category->delete();
        return back()->with('success', "Category Delete Successfull!");
    }

    /**
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function restore($id)
    {
        Category::where('id', $id)->onlyTrashed()->restore();
        return back()->with('success', "Category Re-store Successfull!");
    }

    /**
     *
     * @param  \App\Models\Category  $category
     * @return \Illuminate\Http\Response
     */
    public function permanateDestroy($id)
    {

        return $id;

        return back()->with('success', "Category Re-store Successfull!");
    }
}