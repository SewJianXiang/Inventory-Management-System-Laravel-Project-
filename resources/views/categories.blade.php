<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Category Management - StockSys Malaysia</title>
    <script src="https://cdn.tailwindcss.com"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;600;700&display=swap" rel="stylesheet">
    <style>
        body { font-family: 'Inter', sans-serif; }
    </style>
</head>

<body class="bg-slate-50 min-h-screen flex flex-col">

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
    <aside class="w-72 bg-white border-r border-slate-200 hidden lg:block">
        <div class="p-6">
            <p class="text-xs font-bold text-slate-400 uppercase tracking-widest mb-4">Main Menu</p>
            <nav class="space-y-1">
                <a href="{{ route('dashboard') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('dashboard') ? 'bg-blue-50 text-blue-700 font-bold' : 'text-slate-600 hover:bg-slate-100 transition' }}">
                    <span>📊</span> Dashboard
                </a>
                
                <a href="{{ route('stocks.index') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('stocks.index') ? 'bg-blue-50 text-blue-700 font-bold' : 'text-slate-600 hover:bg-slate-100 transition' }}">
                    <span>📦</span> Inventory Stock
                </a>
                
                <a href="{{ route('categories.index') }}" 
                class="flex items-center gap-3 px-4 py-3 rounded-xl {{ request()->routeIs('categories.index') ? 'bg-blue-50 text-blue-700 font-bold' : 'text-slate-600 hover:bg-slate-100 transition' }}">
                    <span>🗂</span> Categories
                </a>
                
                <a href="#" 
                class="flex items-center gap-3 px-4 py-3 rounded-xl text-slate-600 hover:bg-slate-100 transition">
                    <span>📈</span> Business Reports
                </a>
            </nav>
        </div>
    </aside>

    <main class="flex-1 p-6 md:p-10">
        <div class="max-w-6xl mx-auto">
            <div class="flex justify-between items-end mb-8">
                <div>
                    <h1 class="text-4xl font-extrabold text-slate-800">Category Setup</h1>
                    <p class="text-slate-500 mt-2">Manage your product classifications for the Malaysian market.</p>
                </div>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8 mb-10">
                <h2 class="text-lg font-bold text-slate-800 mb-6 flex items-center gap-2">
                    <span class="w-2 h-6 bg-blue-600 rounded-full"></span>
                    Add New Category
                </h2>
                
                @if ($errors->any())
                    <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6">
                        <ul class="list-disc list-inside text-sm">
                            @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                        </ul>
                    </div>
                @endif

                <form action="{{ route('categories.store') }}" method="POST" class="grid grid-cols-1 md:grid-cols-12 gap-6">
                    @csrf
                    <div class="md:col-span-4">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Category Name</label>
                        <input type="text" name="name" placeholder="e.g., Electronics or Food" 
                            class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition" required>
                    </div>

                    <div class="md:col-span-5">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Description (Optional)</label>
                        <input type="text" name="description" placeholder="Brief details about this category" 
                            class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition">
                    </div>

                    <div class="md:col-span-3 flex items-end">
                        <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition-all shadow-lg shadow-blue-200 flex items-center justify-center gap-2">
                            <span>➕</span> Create Category
                        </button>
                    </div>
                </form>
            </div>

            <div class="bg-white rounded-2xl shadow-sm border border-slate-200 overflow-hidden">
                <div class="px-8 py-6 border-b border-slate-100 flex justify-between items-center">
                    <h2 class="text-lg font-bold text-slate-800">Existing Categories</h2>
                    <span class="bg-slate-100 text-slate-600 text-xs font-bold px-3 py-1 rounded-full">Total: {{ count($categories) }}</span>
                </div>
                
                <div class="overflow-x-auto">
                    <table class="w-full text-left">
                        <thead>
                            <tr class="bg-slate-50 text-slate-500 text-xs uppercase tracking-wider">
                                <th class="px-8 py-4 font-bold">ID</th>
                                <th class="px-8 py-4 font-bold">Category Name</th>
                                <th class="px-8 py-4 font-bold">Description</th>
                                <th class="px-8 py-4 font-bold">Created Date</th>
                                <th class="px-8 py-4 font-bold text-center">Actions</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-slate-100">
    @forelse ($categories as $category)
    <tr class="hover:bg-slate-50/50 transition">
        <td class="px-8 py-5 text-slate-400 font-mono text-sm">#{{ $category->id }}</td>
        <td class="px-8 py-5 font-bold text-slate-700">{{ $category->name }}</td>
        <td class="px-8 py-5 text-slate-500 text-sm italic">{{ $category->description ?? 'No description provided' }}</td>
        <td class="px-8 py-5 text-sm text-slate-500">{{ $category->created_at->format('d M, Y') }}</td>
        <td class="px-8 py-5">
            <div class="flex justify-center gap-3">
                <button class="text-blue-600 hover:bg-blue-50 p-2 rounded-lg transition" title="Edit">
                    ✏️
                </button>

                <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Adakah anda pasti mahu memadam kategori ini?')">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="text-red-600 hover:bg-red-50 p-2 rounded-lg transition" title="Delete">
                        🗑️
                    </button>
                </form>
            </div>
        </td>
    </tr>
    @empty
    <tr>
        <td colspan="5" class="px-8 py-20 text-center">
            <div class="flex flex-col items-center">
                <span class="text-5xl mb-4">empty</span>
                <p class="text-slate-400 italic">No categories found in the system.</p>
            </div>
        </td>
    </tr>
    @endforelse
</tbody>
                    </table>
                </div>
            </div>
        </div>
    </main>
</div>

<footer class="bg-white border-t border-slate-200 text-slate-400 text-center py-6 text-sm">
    &copy; 2025 <span class="font-bold text-slate-600">StockSys Malaysia</span>. All rights reserved.
</footer>

</body>
</html>