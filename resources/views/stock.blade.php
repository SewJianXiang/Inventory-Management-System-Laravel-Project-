@extends('layouts.app')
@section('content')
     <!-- ===== MAIN CONTENT ===== -->
        <main class="flex-1 p-8">
            @yield('content') <!-- Child pages will inject content here -->
            <!-- Add Stock -->
            <div class="bg-white rounded-xl shadow p-6 mb-8"
                x-data="{ showCreate: false }">

                <h2 class="text-2xl font-bold text-slate-800 mb-4">Product Management</h2>


                <div class="p-3 space-x-2">
                <div class="p-0">

                            <!-- PRODUCT MANAGEMENT -->
                            <div class="bg-white rounded-xl shadow p-6 mb-6">
                                <div class="grid sm:grid-cols-2 md:grid-cols-4 gap-2">
                                    <button
                                        @click="showCreate = !showCreate"
                                        class="flex items-center justify-center bg-green-200 text-green-700 hover:bg-green-300 py-3 rounded">
                                         ✚ Create
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

                    @if ($errors->any())
                        <div class="mb-4 p-4 bg-red-100 text-red-700 rounded">
                            <ul class="list-disc pl-5">
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif

                    <form method="POST" action="{{ route('stocks.store') }}" enctype="multipart/form-data" class="grid grid-cols-2 gap-4">
                        @csrf

                        <input type="text" name="product_name" placeholder="Product Name"
                            class="border rounded px-3 py-2 col-span-2" required>

                        <select name="category"
                                class="border rounded px-3 py-2 w-full">
                                <option value="">-- Select Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->name }}" {{ old('category') == $category->name ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
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
                    class="bg-white p-6">
                    <!-- Search & Filter -->
                    <div class="bg-white mb-4 flex flex-wrap gap-4 items-center justify-between">

                        <!-- Search -->
                        <form method="GET" action="{{ route('stocks.index') }}" class="grid grid-cols-1 md:grid-cols-4 items-center gap-2 w-full md:w-2/3">
                            <input type="text" name="search" value="{{ request('search') }}" placeholder="Search by name or category..."
                                           class="md:col-span-2 border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
                            <button type="submit" class="ml-2 bg-blue-500 font-semibold text-white px-3 py-2 rounded hover:bg-blue-600 text-center">Search</button>
                            <a href="{{ route('stocks.index') }}" class="ml-2 bg-gray-200 text-gray-700 font-semibold px-3 py-2 rounded hover:bg-gray-300 text-center">Clear</a>
                        </form>
                        
                        <!-- Category Filter (optional) -->
                        <form method="GET" action="{{ route('stocks.index') }}" class="flex items-center gap-2">
                            <select name="category_name"
                                class="border rounded px-3 py-2 w-full text-md"
                                onchange="this.form.submit()">
                                <option value="">-- Select Category --</option>
                                @foreach ($categories as $category)
                                    <option value="{{ $category->name }}" {{ request('category_name') == $category->name ? 'selected' : '' }}>
                                        {{ $category->name }}
                                    </option>
                                @endforeach
                            </select>
                        </form>
                        </div>
                    </div>
                    <!-- Stock Table -->
                    <div x-show="!showCreate"
                        x-transition
                        x-cloak
                        class="bg-white ">

                        <h2 class="text-2xl font-semibold mb-2">Stock List</h2>
                        <div class="overflow-x-auto rounded-md">
                        <table class="min-w-full text-center">
                            <thead class="bg-blue-600 text-white">
                                <tr>
                                    <th class="p-3 w-[50px]">ID</th>
                                    <th class="p-3 w-[140px]">Product</th>
                                    <th class="p-3 w-[140px]">Category</th>
                                    <th class="p-3 w-[140px]">Qty</th>
                                    <th class="p-3 w-[140px]">Price</th>
                                    <th class="p-3 min-w-[100px]">Status</th>
                                    <th class="p-3 w-[80px]">Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($products as $product)
                                <tr class="border-b hover:bg-slate-50">
                                    <td class="p-3 w-[50px]">{{ $product->id }}</td>
                                    <td class="p-3 w-[140px] break-all">{{ $product->product_name }}</td>
                                    <td class="p-3 w-[140px] break-all">{{ $product->category }}</td>
                                    <td class="p-3 w-[140px]">{{ $product->quantity }}</td>
                                    <td class="p-3 w-[140px]">${{ number_format($product->price, 2) }}</td>
                                    <td class="p-3 min-w-[100px]">
                                        @if ($product->quantity > 10)
                                        <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">In Stock</span>
                                        @elseif ($product->quantity > 0)
                                        <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">Low</span>
                                        @else
                                        <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">Out</span>
                                        @endif
                                    </td>
                                    <td class="p-3 w-[80px]">
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