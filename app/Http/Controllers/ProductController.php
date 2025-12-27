<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{   
      public function index(){

    $products = Product::latest()->get();
    $products = Product::orderBy('id', 'asc')->get(); // fetch all products
    return view('stock', compact('products')); // pass $products to Blade
    
        }
    public function store(Request $request)
    {
        $request->validate([
            'product_name' => 'required|string|max:255',
            'category'     => 'required|string|max:255',
            'quantity'     => 'required|integer|min:0',
            'price'        => 'required|numeric|min:0',
        ]);

        Product::create($request->all());

        return redirect()->route('stocks.index')->with('success', 'Product created successfully!');
    }
}
