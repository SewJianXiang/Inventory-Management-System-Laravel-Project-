<div class="container mx-auto p-6">

    <!-- Create Button -->
    <a href="{{ route('products.index', ['create' => 1]) }}"
       class="bg-green-100 text-green-700 px-4 py-2 rounded hover:bg-green-200">
       ➕ Create
    </a>

    <!-- Inline Create Form -->
    @if($showForm ?? false)
    <div class="bg-white rounded-xl shadow p-6 my-4">
        <h2 class="text-xl font-semibold mb-4">Create Product</h2>

        <form action="{{ route('products.store') }}" method="POST" class="grid grid-cols-4 gap-4">
            @csrf
            <input type="text" name="product_name" placeholder="Product Name" class="border p-2 rounded" required>
            <input type="text" name="category" placeholder="Category" class="border p-2 rounded" required>
            <input type="number" name="quantity" placeholder="Quantity" class="border p-2 rounded" required>
            <input type="number" step="0.01" name="price" placeholder="Price" class="border p-2 rounded" required>
            <button class="col-span-4 bg-green-600 text-white py-2 rounded hover:bg-green-700">Create Product</button>
        </form>
    </div>
    @endif

    <!-- Stock Table -->
    <div class="bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-semibold mb-4">Stock List</h2>

        <div class="overflow-x-auto">
            <table class="min-w-full text-center border">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th>ID</th>
                        <th>Product</th>
                        <th>Category</th>
                        <th>Qty</th>
                        <th>Price</th>
                    </tr>
                </thead>
            <tbody>
                @forelse($products as $product)
                <tr>
                    <td>{{ $product->id }}</td>
                    <td>{{ $product->product_name }}</td>
                    <td>{{ $product->category }}</td>
                    <td>{{ $product->quantity }}</td>
                    <td>{{ number_format($product->price, 2) }}</td>
                </tr>
                @empty
                <tr>
                    <td colspan="5">No products yet.</td>
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>

</div>
