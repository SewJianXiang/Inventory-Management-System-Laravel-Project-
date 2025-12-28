<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stock Management</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>

</head>

<body class="bg-slate-100 min-h-screen flex flex-col">

<!-- ================= TOP NAVBAR ================= -->
<nav class="bg-slate-800 text-white px-6 py-4 flex justify-between items-center">
    <div class="text-xl font-bold">📦 StockSys</div>

    <!-- RIGHT SIDE -->
    <div class="flex items-center space-x-4">
        

        <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}"
             class="w-9 h-9 rounded-full border">

        <span class="text-sm font-medium">
            {{ Auth::user()->name }}
        </span>
        <!-- Logout Button -->
        <form method="POST" action="{{ route('logout') }}" class="inline">
            @csrf
            <button type="submit"
                class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm font-medium transition">
                Logout
            </button>
        </form>

    </div>
</nav>

<!-- ================= MAIN WRAPPER ================= -->
<div class="flex flex-1">

    <!-- ===== SIDEBAR ===== -->
    <aside class="w-64 bg-white shadow-lg">
        <div class="p-6 font-semibold text-lg border-b">
            Menu
        </div>

        <nav class="p-4 space-y-2">
            <a href="#"
               class="block px-4 py-2 rounded-lg bg-blue-100 text-blue-700 font-semibold">
                📊 Dashboard
            </a>

            <a href="#"
               class="block px-4 py-2 rounded-lg hover:bg-slate-100">
                📦 Stock
            </a>

            <a href="#"
               class="block px-4 py-2 rounded-lg hover:bg-slate-100">
                🗂 Categories
            </a>

            <a href="#"
               class="block px-4 py-2 rounded-lg hover:bg-slate-100">
                📈 Reports
            </a>
            <a href="#"
               class="block px-4 py-2 rounded-lg hover:bg-slate-100">
                📈 Setting
            </a>
            <a href="#"
               class="block px-4 py-2 rounded-lg hover:bg-slate-100">
                📈 Reports
            </a>
            <a href="#"
               class="block px-4 py-2 rounded-lg hover:bg-slate-100">
                📈 Reports
            </a>
        </nav>
    </aside>

    <!-- ===== MAIN CONTENT ===== -->
    <main class="flex-1 p-8">
        @yield('content')  <!-- Child pages will inject content here -->
        <h1 class="text-3xl font-bold mb-6">📦 Stock Management</h1>

        <!-- Add Stock -->
        <div class="bg-white rounded-xl shadow p-6 mb-8"
                x-data="{ showCreate: false }">
                
                <h2 class="text-xl font-semibold mb-4">Product Management</h2>


            <td class="p-3 space-x-2">
    <td class="p-0">
    
    <div x-data="{ showCreate: false }">

    <!-- Product Management -->
    <div x-data="{ showCreate: false }">

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

</td>
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
        <div class="bg-white rounded-xl shadow p-4 mb-6 flex flex-wrap gap-4 items-center justify-between">

            <!-- Search -->
            <div class="flex items-center gap-2 w-full md:w-1/3">
                <input type="text"
                    placeholder="Search product..."
                    class="w-full border rounded-lg px-3 py-2 focus:outline-none focus:ring-2 focus:ring-blue-500">
            </div>

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
            class="bg-white rounded-xl shadow p-6">
                
                <h2 class="text-xl font-semibold mb-4">Stock List</h2>
            <!-- CREATE FORM -->
            <table class="w-full text-center">
                <thead class="bg-blue-600 text-white">
                    <tr>
                        <th class="p-3">ID</th>
                        <th class="p-3">Image</th>
                        <th class="p-3">Product</th>
                        <th class="p-3">Category</th>
                        <th class="p-3">Qty</th>
                        <th class="p-3">Price</th>
                        <th class="p-3">Status</th>
                        <th class="p-3">Action</th>
                         <th class="p-3">Created By</th>
                    </tr>
                </thead>

               <tbody>
        @foreach ($products as $product)
            <tr class="border-b hover:bg-slate-50">
                <td class="p-3">{{ $product->id }}</td>
                <td class="p-3 flex justify-center items-center">
                    @if($product->image)
                        <img src="{{ asset('storage/' . $product->image) }}" alt="Product Image" class="w-30 h-20 object-cover rounded">
                    @else
                        N/A
                    @endif
                </td>
                <td class="p-3">{{ $product->product_name }}</td>
                <td class="p-3">{{ $product->category }}</td>
                <td class="p-3">{{ $product->quantity }}</td>
                <td class="p-3">{{ number_format($product->price, 2) }}</td>
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
                     <td>{{ $product->created_by }}</td>
        @endforeach
</tbody>

            </table>
        </div>
        </div>

    </main>

</div>

<!-- ================= FOOTER ================= -->
<footer class="bg-slate-800 text-slate-300 text-center py-3">
    © 2025 StockSys
</footer>

</body>
</html>
