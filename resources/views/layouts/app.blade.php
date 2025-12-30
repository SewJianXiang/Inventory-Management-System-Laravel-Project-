<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'Inventory Management System')</title>
    <script src="https://cdn.tailwindcss.com"></script>
     <script defer src="https://unpkg.com/alpinejs@3.x.x/dist/cdn.min.js"></script>
</head>

<body class="bg-slate-100 min-h-screen flex flex-col">

    <!-- TOP NAV -->
    <nav class="bg-slate-800 text-white px-6 py-4 flex justify-between items-center">
        <div class="text-xl font-bold">📦 StockSys</div>
        @auth
        <div class="flex items-center space-x-4">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}"
                 class="w-9 h-9 rounded-full border">
            <span class="text-sm font-medium">{{ Auth::user()->name }}</span>
            <form method="POST" action="{{ route('logout') }}">
                @csrf
                <button class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg text-sm">
                    Logout
                </button>
            </form>
        </div>
        @endauth
    </nav>

    <!-- MAIN AREA -->
    <div class="flex flex-1">

        <!-- SIDEBAR -->
        <aside class="w-64 bg-white shadow-lg">
            <div class="p-6 font-semibold text-lg border-b">Menu</div>
            <nav class="p-4 space-y-2">
                <a class="block px-4 py-2 rounded-lg bg-blue-100 text-blue-700 font-semibold">📊 Dashboard</a>
                <a class="block px-4 py-2 rounded-lg hover:bg-slate-100">📦 Stock</a> 
                <a class="block px-4 py-2 rounded-lg hover:bg-slate-100">🗂 Categories</a>
                <a href="{{ route('products.histories') }}" class="block px-4 py-2 rounded-lg hover:bg-slate-100">📈 History</a>
                <a class="block px-4 py-2 rounded-lg hover:bg-slate-100">⚙ Setting</a>
            </nav>
        </aside>

        <!-- CONTENT -->
        <main class="flex-1 p-8">
            @yield('content')
        </main>

    </div>

    <!-- FOOTER -->
    <footer class="bg-slate-800 text-slate-300 text-center py-3">
        © 2025 StockSys
    </footer>

</body>
</html>
