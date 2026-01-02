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
                <a href="{{ route('user.settings.password') }}"
                class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('settings.password') ? 'bg-blue-50 text-blue-700 font-bold' : 'text-slate-600 hover:bg-slate-100 transition' }}">
                    <span>⚙</span> Settings
                </a>
                
                @if(Auth::user()->is_admin == 1)
                 <a href="{{ route('admin.dashboard') }}"
                class="flex items-center gap-2 px-4 py-2 rounded-lg hover:bg-slate-100">
                    <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 48 48" id="User-Switch-Account--Streamline-Plump" class="w-5 h-5">
                    <g id="user-switch-account">
                        <path id="Union" fill="#000000" fill-rule="evenodd" d="M5.686 11.58c0.048 -1.005 0.1 -1.898 0.155 -2.683 0.26 -3.784 3.168 -6.75 6.975 -7.034 2.553 -0.19 6.25 -0.363 11.238 -0.363 0.325 0 0.644 0 0.957 0.002a2.5 2.5 0 0 1 -0.022 5l-0.935 -0.002c-4.873 0 -8.445 0.17 -10.867 0.35 -1.303 0.097 -2.267 1.062 -2.358 2.39 -0.048 0.695 -0.095 1.483 -0.139 2.37 0.787 0.065 1.55 0.16 2.265 0.283 1.746 0.303 2.55 2.281 1.569 3.72 -1.574 2.306 -3.689 4.607 -4.753 5.72a2.452 2.452 0 0 1 -3.54 0.011c-1.103 -1.138 -3.348 -3.545 -4.824 -5.779 -0.962 -1.454 -0.109 -3.364 1.58 -3.661a26.42 26.42 0 0 1 2.699 -0.324ZM43.5 8a6.5 6.5 0 1 0 -10.648 5.004c-2.733 1.292 -4.776 3.837 -5.422 6.907 -0.309 1.463 0.939 2.59 2.283 2.59h14.458c1.344 0 2.592 -1.127 2.284 -2.59 -0.641 -3.043 -2.653 -5.569 -5.35 -6.872A6.488 6.488 0 0 0 43.5 8Zm-39 24a6.5 6.5 0 1 1 10.648 5.004c2.733 1.292 4.776 3.837 5.422 6.907 0.309 1.463 -0.939 2.59 -2.283 2.59H3.829c-1.344 0 -2.592 -1.127 -2.284 -2.59 0.641 -3.043 2.653 -5.569 5.35 -6.872A6.488 6.488 0 0 1 4.5 32Zm40.514 4.096a26.27 26.27 0 0 1 -2.7 0.324 128.661 128.661 0 0 1 -0.155 2.683c-0.26 3.785 -3.17 6.75 -6.976 7.034 -1.994 0.148 -4.685 0.286 -8.144 0.34a2.5 2.5 0 1 1 -0.078 -5c3.367 -0.052 5.96 -0.186 7.85 -0.326 1.305 -0.098 2.269 -1.063 2.36 -2.391 0.048 -0.695 0.095 -1.483 0.139 -2.37 -0.787 -0.065 -1.55 -0.16 -2.265 -0.283 -1.746 -0.303 -2.55 -2.281 -1.569 -3.72 1.574 -2.306 3.69 -4.607 4.753 -5.72a2.452 2.452 0 0 1 3.54 -0.011c1.103 1.138 3.348 3.545 4.824 5.779 0.962 1.454 0.109 3.364 -1.58 3.661Z" clip-rule="evenodd" stroke-width="1"></path>
                    </g>
                    </svg>
                    <span>Admin Panel</span>
                </a>
                @endif
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
