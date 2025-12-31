<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title', 'StockSys Malaysia')</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-slate-50 min-h-screen flex flex-col">

<!-- NAVBAR -->
<nav class="bg-slate-900 text-white px-8 py-4 flex justify-between items-center shadow-md">
    <div class="flex items-center gap-2 text-2xl font-bold tracking-tight">
        <span class="bg-blue-600 p-1.5 rounded-lg">📦</span>
        <span>Stock<span class="text-blue-400">Sys</span></span>
    </div>
    <div class="flex items-center space-x-6">
        <div class="flex items-center gap-3">
            <img src="https://ui-avatars.com/api/?name={{ urlencode(Auth::user()->name) }}&background=0D8ABC&color=fff" class="w-10 h-10 rounded-full border-2 border-slate-700">
            <div class="hidden md:block">
                <p class="text-sm font-semibold leading-none">{{ Auth::user()->name }}</p>
                <p class="text-xs text-slate-400 mt-1">Administrator</p>
            </div>
        </div>
        <form method="POST" action="{{ route('logout') }}">
            @csrf
            <button type="submit" class="bg-red-500 hover:bg-red-600 text-white px-5 py-2 rounded-xl text-sm font-bold transition-all shadow-sm">
                Logout
            </button>
        </form>
    </div>
</nav>

<div class="flex flex-1">
    <!-- SIDEBAR -->
    <aside class="w-72 bg-white border-r border-slate-200 hidden lg:block">
        <div class="p-6">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Main Menu</p>
            <nav class="space-y-1">
                <a href="{{ route('dashboard') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700 font-bold' : 'text-slate-600 hover:bg-slate-100 transition' }}">
                    <span>📊</span> Dashboard
                </a>
                
                <a href="{{ route('user_products.index') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('stocks.index') ? 'bg-blue-50 text-blue-700 font-bold' : 'text-slate-600 hover:bg-slate-100 transition' }}">
                    <span>📦</span> Inventory Stock
                </a>
                
                <a href="{{ route('user_categories.index') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('categories.index') ? 'bg-blue-50 text-blue-700 font-bold' : 'text-slate-600 hover:bg-slate-100 transition' }}">
                    <span>🗂</span> Categories
                </a>
                
                <a href="#" 
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-100 transition">
                    <span>📈</span> Business Reports
                </a>

                <!-- Settings Link -->
                <a href="{{ route('settings.password') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('settings.password') ? 'bg-blue-50 text-blue-700 font-bold' : 'text-slate-600 hover:bg-slate-100 transition' }}">
                    <span>⚙</span> Settings
                </a>
            </nav>
        </div>
    </aside>

    <!-- MAIN CONTENT -->
    <main class="flex-1 p-8">
        @yield('content')
    </main>
</div>

<!-- FOOTER -->
<footer class="bg-white border-t border-slate-200 text-slate-400 text-center py-6 text-sm">
    &copy; 2025 <span class="font-bold text-slate-600">StockSys Malaysia</span>. All rights reserved.
</footer>

</body>
</html>
