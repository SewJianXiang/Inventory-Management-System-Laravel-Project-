@extends('layouts.app')
@section('content')
     <!-- ===== MAIN CONTENT ===== -->
        <main class="flex-1 p-8">
            @yield('content') <!-- Child pages will inject content here -->
            <h1 class="text-3xl font-bold mb-6">📦 Stock Management</h1>

            <!-- Add Stock -->
            <div class="bg-white rounded-xl shadow p-6 mb-8"
                x-data="{ showCreate: false }">

                <h2 class="text-xl font-semibold mb-4">Product Management</h2>


                <div class="p-3 space-x-2">
                <div class="p-0">

                            <!-- PRODUCT MANAGEMENT -->
                            <div class="bg-white rounded-xl shadow p-6 mb-6">
                                <div class="grid grid-cols-4 gap-2">
                                    <button
                                        @click="showCreate = !showCreate"
                                        class="flex items-center justify-center bg-green-100 text-green-700 hover:bg-green-200 py-3 rounded">
                                        ➕ Create
                                    </button>
                                    <button class="flex items-center justify-center bg-red-100 text-red-700 hover:bg-red-200 py-3 rounded">
                                        🗑 Delete
                                    </button>
                                </div>
                            </div>

                </div>
                <!-- CREATE FORM -->
                <div x-show="showCreate"
                    x-transition
                    x-cloak
                    class="bg-white rounded-xl shadow p-6 mb-6">

                    <h2 class="text-xl font-semibold mb-4">Create New Stock</h2>

                    <form method="POST" action="{{ route('stocks.store') }}" enctype="multipart/form-data" class="grid grid-cols-2 gap-4">
                        @csrf

                        <input type="text" name="product_name" placeholder="Product Name"
                            class="border rounded px-3 py-2 col-span-2" required>

                        <input type="text" name="category" placeholder="Category"
                            class="border rounded px-3 py-2" required>

                        <input type="file" name="image" accept="image/*"
                            class="border px-3 py-2 col-span-2" required>

                        <input type="number" name="quantity" placeholder="Quantity"
                            class="border rounded px-3 py-2" required>

                        <input type="number" step="0.01" name="price" placeholder="Price"
                            class="border rounded px-3 py-2 col-span-2" required>

                        <div class="col-span-2 flex gap-2">
                            <button type="submit"
                                class="bg-green-600 text-white px-4 py-2 rounded hover:bg-green-700">
                                Save
                            </button>

                            <button type="button"
                                @click="showCreate = false"
                                class="bg-gray-400 text-white px-4 py-2 rounded hover:bg-gray-500">
                                Cancel
                            </button>
                        </div>
                    </form>


                </div>
                <div x-show="!showCreate"
                    x-transition
                    x-cloak
                    class="bg-white rounded-xl shadow p-6">
                    <!-- Search & Filter -->
                    <div class="bg-white mb-4 flex flex-wrap gap-4 items-center justify-between">

                        <!-- Search -->
                        <form method="GET" action="{{ route('stocks.index') }}" class="flex items-center gap-2 w-full md:w-2/3">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search product by name or category..."
                                class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <button type="submit" class="ml-2 bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-600">Search</button>
                            <a href="{{ route('stocks.index') }}" class="ml-2 bg-gray-200 text-gray-700 px-3 py-2 rounded hover:bg-gray-300">Clear</a>
                        </form>

                        <!-- Category Filter (optional) -->
                        <div class="flex items-center gap-2">
                            <select class="border rounded-lg px-3 py-2">
                                <option value="">All Categories</option>
                                <option>Food</option>
                                <option>Electronics</option>
                                <option>Accessories</option>
                            </select>
                        </div>
                    </div>
                    <!-- Stock Table -->
                    <div x-show="!showCreate"
                        x-transition
                        x-cloak
                        class="bg-white ">

                        <h2 class="text-2xl font-semibold mb-2">Stock List</h2>
                        <!-- CREATE FORM -->
                        <table class="w-full text-center">
                            <thead class="bg-blue-600 text-white">
                                <tr>
                                    <th class="p-3">ID</th>
                                    <th class="p-3">Product</th>
                                    <th class="p-3">Category</th>
                                    <th class="p-3">Qty</th>
                                    <th class="p-3">Price</th>
                                    <th class="p-3">Status</th>
                                    <th class="p-3">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($products as $product)
                                <tr class="border-b hover:bg-slate-50">
                                    <td class="p-3">{{ $product->id }}</td>
                                    <td class="p-3">{{ $product->product_name }}</td>
                                    <td class="p-3">{{ $product->category }}</td>
                                    <td class="p-3">{{ $product->quantity }}</td>
                                    <td class="p-3">${{ number_format($product->price, 2) }}</td>
                                    <td class="p-3">
                                        @if ($product->quantity > 10)
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">In Stock</span>
                                        @elseif ($product->quantity > 0)
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">Low</span>
                                        @else
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">Out</span>
                                        @endif
                                    </td>
                                    <td class="p-3">
                                        <a href="{{ route('products.show', $product->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                                            View
                                        </a>
                                    @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>

        </main>
@endsection