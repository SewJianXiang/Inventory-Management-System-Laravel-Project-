<?php

namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{   
      public function index(Request $request)
    {
        $search = $request->query('search');

        $productsQuery = Product::query();

        if ($search) {
            $productsQuery->where('product_name', 'LIKE', "%{$search}%")
                          ->orWhere('category', 'LIKE', "%{$search}%");
        }

        $products = $productsQuery->orderBy('id', 'asc')->get(); // fetch filtered products

        return view('stock', compact('products')); // pass $products to Blade
    }

    public function store(Request $request)
    {
        // Validate input and store in $validated
        $validated = $request->validate([
            'product_name' => 'required|string|max:255',
            'category'     => 'required|string|max:255',
            'quantity'     => 'required|integer|min:0',
            'price'        => 'required|numeric|min:0',
            'image'        => 'nullable|image|mimes:jpg,jpeg,png,gif|max:2048',
        ]);
        if ($request->hasFile('image')) {
            $validated['image'] = $request->file('image')->store('products', 'public');
        }
        // Add the authenticated user's ID and name
        $validated['user_id'] = auth()->id();
        $validated['created_by'] = auth()->user()->name;

        // Create the product
        Product::create($validated);

        return redirect()->route('stocks.index')
            ->with('success', 'Product created successfully!');

    }

    public function show($id)
        {
            $product = Product::findOrFail($id);
            return view('products.show', compact('product'));
        }

    public function update(Request $request, Product $product)
{
    $request->validate([
        'product_name' => 'required|string|max:255',
        'price' => 'required|numeric',
        'image' => 'nullable|image|max:2048',
    ]);

    // Update text data
    $product->product_name = $request->product_name;
    $product->price = $request->price;

    // Update image if uploaded
    if ($request->hasFile('image')) {

        // delete old image
        if ($product->image && Storage::exists($product->image)) {
            Storage::delete($product->image);
        }

        $path = $request->file('image')->store('products', 'public');
        $product->image = $path;
    }

    $product->save();

    return redirect()
        ->route('products.show', $product->id)
        ->with('success', 'Product updated successfully!');
}
}
