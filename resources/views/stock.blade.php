<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Stock Management</title>

    <!-- Tailwind CDN -->
    <script src="https://cdn.tailwindcss.com"></script>
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

        <h1 class="text-3xl font-bold mb-6">📦 Stock Management</h1>

        <!-- Add Stock -->
        <div class="bg-white rounded-xl shadow p-6 mb-8">
            <h2 class="text-xl font-semibold mb-4">Add New Stock</h2>

            <form class="grid grid-cols-5 gap-4">
                <input type="text" placeholder="Product Name"
                    class="border rounded-lg px-3 py-2">

                <input type="text" placeholder="Category"
                    class="border rounded-lg px-3 py-2">

                <input type="number" placeholder="Quantity"
                    class="border rounded-lg px-3 py-2">

                <input type="number" placeholder="Price (RM)"
                    class="border rounded-lg px-3 py-2">

                <button class="bg-blue-600 text-white rounded-lg hover:bg-blue-700">
                    ➕ Add
                </button>
            </form>
        </div>
        <div class="bg-white rounded-xl shadow p-6 mb-8">
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
        <div class="bg-white rounded-xl shadow p-6">
            <h2 class="text-xl font-semibold mb-4">Stock List</h2>

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
                @foreach ($stocks as $stock)
                    <tr class="border-b hover:bg-slate-50">
                        <td class="p-3">{{ $stock->id }}</td>
                        <td class="p-3">{{ $stock->product_name }}</td>
                        <td class="p-3">{{ $stock->category }}</td>
                        <td class="p-3">{{ $stock->quantity }}</td>
                        <td class="p-3">{{ number_format($stock->price, 2) }}</td>

                        <td class="p-3">
                            @if ($stock->quantity > 10)
                                <span class="bg-green-100 text-green-700 px-3 py-1 rounded-full text-sm">
                                    In Stock
                                </span>
                            @elseif ($stock->quantity > 0)
                                <span class="bg-yellow-100 text-yellow-700 px-3 py-1 rounded-full text-sm">
                                    Low
                                </span>
                            @else
                                <span class="bg-red-100 text-red-700 px-3 py-1 rounded-full text-sm">
                                    Out
                                </span>
                            @endif
                        </td>

                        <td class="p-3 space-x-2">
                            <button class="bg-yellow-400 px-3 py-1 rounded hover:bg-yellow-500">
                                Edit
                            </button>
                            <button class="bg-red-500 text-white px-3 py-1 rounded hover:bg-red-600">
                                Delete
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>

            </table>
        </div>

    </main>

</div>

<!-- ================= FOOTER ================= -->
<footer class="bg-slate-800 text-slate-300 text-center py-3">
    © 2025 StockSys
</footer>

</body>
</html>
