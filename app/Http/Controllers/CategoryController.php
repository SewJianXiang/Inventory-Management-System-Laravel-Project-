<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; 

class CategoryController extends Controller{

    // Show the form to edit an existing category
    public function edit($id)
    {
        $category = Category::findOrFail($id);
        return view('categories_edit', compact('category'));
    }

    // Update an existing category
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);
        $request->validate([
            'name' => 'required|max:255|unique:categories,name,' . $id,
            'image'=> 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:10240',
        ]);

        $imagePath = $category->image;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        $category->update([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->route('categories.index')->with('success', 'Category updated successfully!');
    }

    // Show details of a single category (optional)
    public function show($id)
    {
        $category = Category::findOrFail($id);
        return view('categories_show', compact('category'));
    }

    public function index()
    {

        $categories = Category::all(); 
        return view('categories', compact('categories'));
    }

    public function showCategory()
    {
        $categories = Category::all(); 
        return view('stock', compact('categories'));
    }

    public function user_categoryIndex()
    {
    $categories = Category::all();
    return view('user.user_category', compact('categories'));
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|max:255|unique:categories,name',
            'image'=> 'nullable|image|mimes:jpg,jpeg,png,gif,webp|max:10240',
        ]);

        $imagePath = null;
        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('categories', 'public');
        }

        Category::create([
            'name' => $request->name,
            'description' => $request->description,
            'image' => $imagePath,
        ]);

        return redirect()->back()->with('success', 'Category added successfully!');
    }
    //delete category
    public function destroy($id)
{
    $category = Category::findOrFail($id);
    $category->delete();

    return redirect()->back()->with('success', 'Category deleted successfully!');
}
}