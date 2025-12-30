@extends('layouts.app')
@section('content')
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
@endsection