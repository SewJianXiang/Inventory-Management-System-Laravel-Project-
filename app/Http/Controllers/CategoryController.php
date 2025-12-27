<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Category; 

class CategoryController extends Controller
{
    public function index()
    {

        $categories = Category::all(); 
        return view('categories', compact('categories'));
    }

    public function store(Request $request)
    {

            $request->validate([
                'name' => 'required|max:255|unique:categories,name',
            ]);


            Category::create([
                'name' => $request->name,
                'description' => $request->description,
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
