<?php

namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\ProductHistory;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Storage;
class ProductController extends Controller
{   
      public function index(Request $request)
    {
        $search = $request->query('search');
        $productsQuery = Product::query();
        $categoryName = $request->query('category_name');
        
        
        if ($search) {
            $productsQuery->where('product_name', 'LIKE', "%{$search}%")
                          ->orWhere('category', 'LIKE', "%{$search}%");
        }

       if ($categoryName) {
        $productsQuery->where('category', $categoryName);
        }

        $categories = Category::all();
        $products = $productsQuery->orderBy('id', 'asc')->get(); // fetch filtered products

        return view('stock', compact('products', 'categories')); // pass $products to Blade
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
        $product = Product::create($validated);

        // Create history record for creation (store tracked fields only)
        $newValues = [
            'name' => $validated['product_name'],
            'category' => $validated['category'],
            'quantity' => $validated['quantity'],
            'price' => $validated['price'],
            'image' => $validated['image'] ?? null,
        ];

        ProductHistory::create([
            'product_id' => $product->id,
            'user_id' => auth()->id(),
            'user_name' => auth()->user()->name,
            'action' => 'created',
            'previous_values' => null,
            'new_values' => $newValues,
        ]);

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
            'category' => 'required|string|max:255',
            'quantity' => 'required|integer|min:0',
            'price' => 'required|numeric',
            'image' => 'nullable|image|max:2048',
        ]);

        // Tracked fields mapping
        $tracked = ['product_name' => 'name', 'category' => 'category', 'quantity' => 'quantity', 'price' => 'price', 'image' => 'image'];

        // Capture old values
        $oldValues = [
            'name' => $product->product_name,
            'category' => $product->category,
            'quantity' => $product->quantity,
            'price' => $product->price,
            'image' => $product->image,
        ];

        // Update text data
        $product->product_name = $request->product_name;
        $product->category = $request->category;
        $product->quantity = $request->quantity;
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

        // Capture new values
        $newValues = [
            'name' => $product->product_name,
            'category' => $product->category,
            'quantity' => $product->quantity,
            'price' => $product->price,
            'image' => $product->image,
        ];

        // Determine changed fields
        $previous = [];
        $current = [];
        foreach ($newValues as $key => $value) {
            $old = $oldValues[$key] ?? null;
            if ($old != $value) {
                $previous[$key] = $old;
                $current[$key] = $value;
            }
        }

        // Only store history if something changed among tracked fields
        if (!empty($previous)) {
            ProductHistory::create([
                'product_id' => $product->id,
                'user_id' => auth()->id(),
                'user_name' => auth()->user()->name,
                'action' => 'updated',
                'previous_values' => $previous,
                'new_values' => $current,
            ]);
        }

        return redirect()
            ->route('products.show', $product->id)
            ->with('success', 'Product updated successfully!');
    }

    // History view for a product
    public function history(Product $product)
    {
        $histories = $product->histories()->orderBy('created_at', 'desc')->get();
        return view('history', compact('product', 'histories'));
    }

    // History view for all products
    public function histories()
    {
        $histories = ProductHistory::with('product')->orderBy('created_at', 'desc')->paginate(10);
        return view('history', compact('histories'));
    }
}
