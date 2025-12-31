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
                    <button type="submit" class="w-full bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 rounded-xl transition-all flex items-center justify-center gap-2">
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" class="w-6 h-6 text-white" fill="currentColor">
                            <path d="M352 128C352 110.3 337.7 96 320 96C302.3 96 288 110.3 288 128L288 288L128 288C110.3 288 96 302.3 96 320C96 337.7 110.3 352 128 352L288 352L288 512C288 529.7 302.3 544 320 544C337.7 544 352 529.7 352 512L352 352L512 352C529.7 352 544 337.7 544 320C544 302.3 529.7 288 512 288L352 288L352 128z"/>
                        </svg>
                        Create Category
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
                                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" class="w-6 h-6 "><path d="M535.6 85.7C513.7 63.8 478.3 63.8 456.4 85.7L432 110.1L529.9 208L554.3 183.6C576.2 161.7 576.2 126.3 554.3 104.4L535.6 85.7zM236.4 305.7C230.3 311.8 225.6 319.3 222.9 327.6L193.3 416.4C190.4 425 192.7 434.5 199.1 441C205.5 447.5 215 449.7 223.7 446.8L312.5 417.2C320.7 414.5 328.2 409.8 334.4 403.7L496 241.9L398.1 144L236.4 305.7zM160 128C107 128 64 171 64 224L64 480C64 533 107 576 160 576L416 576C469 576 512 533 512 480L512 384C512 366.3 497.7 352 480 352C462.3 352 448 366.3 448 384L448 480C448 497.7 433.7 512 416 512L160 512C142.3 512 128 497.7 128 480L128 224C128 206.3 142.3 192 160 192L256 192C273.7 192 288 177.7 288 160C288 142.3 273.7 128 256 128L160 128z"/></svg>
                                    </button>

                                    <form action="{{ route('categories.destroy', $category->id) }}" method="POST" onsubmit="return confirm('Adakah anda pasti mahu memadam kategori ini?')">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="text-red-600 hover:bg-red-50 p-2 rounded-lg transition" title="Delete">
                                            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 640 640" class="w-6 h-6 "><path d="M232.7 69.9L224 96L128 96C110.3 96 96 110.3 96 128C96 145.7 110.3 160 128 160L512 160C529.7 160 544 145.7 544 128C544 110.3 529.7 96 512 96L416 96L407.3 69.9C402.9 56.8 390.7 48 376.9 48L263.1 48C249.3 48 237.1 56.8 232.7 69.9zM512 208L128 208L149.1 531.1C150.7 556.4 171.7 576 197 576L443 576C468.3 576 489.3 556.4 490.9 531.1L512 208z"/></svg>
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