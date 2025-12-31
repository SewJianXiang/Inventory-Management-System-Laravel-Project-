@extends('layouts.userlayout')

@section('title', 'StockSys Malaysia')

@section('content')
<h1 class="text-3xl font-bold mb-6">📦 Stock Management</h1>

<div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
    <!-- RIGHT SIDE: PRODUCT LIST -->
    <div class="lg:col-span-2 bg-white rounded-xl shadow p-6">
        <h2 class="text-xl font-semibold mb-4">Stock List</h2>

        <!-- Search & Filter -->
        <div class="flex flex-wrap gap-2 mb-4">
            <form method="GET" action="{{ route('user_products.index') }}" class="flex gap-2 w-full md:w-2/3">
                <input type="text" name="search" value="{{ request('search') }}" placeholder="Search product..."
                    class="border rounded px-3 py-2 w-full">
                <button type="submit" class="bg-blue-500 text-white px-3 py-2 rounded hover:bg-blue-600">Search</button>
                <a href="{{ route('user_products.index') }}" class="bg-gray-200 text-gray-700 px-3 py-2 rounded hover:bg-gray-300">Clear</a>
            </form>

            <form method="GET" action="{{ route('user_products.index') }}">
                <select name="category_name" class="border rounded px-3 py-2"
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

        <table class="w-full text-center border-collapse">
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
                            <a href="{{ route('products.user_show', $product->id) }}" class="bg-blue-500 text-white px-3 py-1 rounded hover:bg-blue-600">
                            View
                        </a>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>

</div>
@endsection
