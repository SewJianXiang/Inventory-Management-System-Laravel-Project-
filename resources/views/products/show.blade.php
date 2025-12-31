
@extends('layouts.app')

@section('title', $product->product_name)

@section('content')
<div class="bg-slate-100 min-h-screen p-8">
    <!-- Product View Section -->
    <div id="productView">
        <div class="max-w-6xl mx-auto grid grid-cols-1 md:grid-cols-2 gap-8 bg-white p-6 rounded-xl shadow relative">
            <!-- Back to Products (inside card, top-right) -->
            <a href="{{ route('stocks.index') }}"
               class="absolute top-4 right-4 inline-flex items-center gap-2 text-blue-600 hover:text-blue-800 font-medium">
                <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                        d="M15 19l-7-7 7-7" />
                </svg>
                Back to Products
            </a>
            <!-- Product Image -->
            <div>
                <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/400' }}" 
                     alt="{{ $product->product_name }}" 
                     class="w-full h-[400px] object-cover rounded-lg mb-4">
                <!-- Thumbnails -->
                <div class="flex gap-2 mt-4">
                    <img src="{{ $product->image ? asset('storage/' . $product->image) : 'https://via.placeholder.com/100' }}" 
                         alt="" class="w-20 h-20 object-cover rounded cursor-pointer border-2 border-blue-500">
                    <img src="https://via.placeholder.com/100" alt="" class="w-20 h-20 object-cover rounded cursor-pointer">
                    <img src="https://via.placeholder.com/100" alt="" class="w-20 h-20 object-cover rounded cursor-pointer">
                    <img src="https://via.placeholder.com/100" alt="" class="w-20 h-20 object-cover rounded cursor-pointer">
                </div>
            </div>
            <!-- Product Details -->
            <div class="flex flex-col justify-start">
                <h1 class="text-3xl font-bold mb-2">{{ $product->product_name }}</h1>
                <p class="text-gray-500 mb-4">SKU: {{ $product->id }}</p>
                <div class="flex items-center gap-4 mb-4">
                    <span class="text-2xl font-semibold text-gray-900">${{ number_format($product->price, 2) }}</span>
                </div>
                <!-- Color Options (static example) -->
                <div class="mb-4">
                    <p class="font-semibold mb-1">Color:</p>
                    <div class="flex gap-2">
                        <span class="w-6 h-6 rounded-full bg-black cursor-pointer border-2 border-gray-300"></span>
                        <span class="w-6 h-6 rounded-full bg-gray-300 cursor-pointer border-2 border-gray-300"></span>
                        <span class="w-6 h-6 rounded-full bg-blue-500 cursor-pointer border-2 border-gray-300"></span>
                    </div>
                </div>
                <div class="mb-6 flex gap-4">
                    <!-- Edit Button -->
                    <button onclick="openEdit()" class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700 flex items-center gap-2">
                        <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15.232 5.232l3.536 3.536M4 13v7h7l11-11-7-7-11 11z"/>
                        </svg>
                        Edit
                    </button>
                    <!-- Delete Button -->
                    <form method="POST" action="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="bg-red-600 text-white px-4 py-2 rounded hover:bg-red-700 flex items-center gap-2" onclick="return confirm('Are you sure you want to delete this product?');">
                            <svg class="w-5 h-5" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
                            </svg>
                            Delete
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Edit Modal Section -->
    <div id="editModal" class="hidden fixed inset-0 bg-black/50 flex items-center justify-center z-50">
        <div class="bg-white w-full max-w-lg p-6 rounded-xl shadow-lg">
            <h2 class="text-2xl font-bold mb-4">Edit Product</h2>
            <form method="POST" action="{{ route('products.update', $product->id) }}" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <!-- Product Name -->
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Product Name</label>
                    <input type="text" name="product_name" value="{{ old('product_name', $product->product_name) }}" class="w-full border rounded px-3 py-2">
                </div>
                <!-- Category (Dropdown) -->
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Category</label>
                    <select name="category" class="w-full border rounded px-3 py-2">
                        <option value="">-- Select Category --</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->name }}" {{ old('category', $product->category) == $category->name ? 'selected' : '' }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <!-- Quantity -->
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Quantity</label>
                    <input type="number" name="quantity" value="{{ old('quantity', $product->quantity) }}" class="w-full border rounded px-3 py-2">
                </div>
                <!-- Price -->
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Price</label>
                    <input type="number" step="0.01" name="price" value="{{ old('price', $product->price) }}" class="w-full border rounded px-3 py-2">
                </div>
                <!-- Image -->
                <div class="mb-4">
                    <label class="block font-semibold mb-1">Product Image</label>
                    <input type="file" name="image" class="w-full border rounded px-3 py-2">
                </div>
                <!-- Buttons -->
                <div class="flex justify-end gap-3">
                    <button type="button" onclick="closeEdit()" class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">Cancel</button>
                    <button type="submit" class="bg-blue-600 text-white px-4 py-2 rounded hover:bg-blue-700">Update</button>
                </div>
            </form>
        </div>
    </div>
</div>
<!-- Modal JS -->
<script>
    function openEdit() {
        document.getElementById('productView').classList.add('hidden');
        document.getElementById('editModal').classList.remove('hidden');
    }
    function closeEdit() {
        document.getElementById('editModal').classList.add('hidden');
        document.getElementById('productView').classList.remove('hidden');
    }
</script>
@endsection
