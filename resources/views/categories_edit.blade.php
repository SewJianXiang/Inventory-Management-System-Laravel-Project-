@extends('layouts.app')

@section('content')
<main class="flex-1 p-6 md:p-10">
    <div class="max-w-4xl mx-auto">
        <div class="mb-8">
            <a href="{{ route('categories.index') }}" class="text-blue-600 hover:text-blue-800 flex items-center gap-2 mb-4 transition font-medium">
                <svg xmlns="http://www.w3.org/2000/svg" class="w-5 h-5" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                </svg>
                Back to Category Setup
            </a>
            <h1 class="text-4xl font-extrabold text-slate-800">Edit Category</h1>
            <p class="text-slate-500 mt-2">Modify the classification details for the Malaysian market.</p>
        </div>

        <div class="bg-white rounded-2xl shadow-sm border border-slate-200 p-8">
            <h2 class="text-lg font-bold text-slate-800 mb-6">Update Category Details</h2>

            @if ($errors->any())
            <div class="bg-red-50 border-l-4 border-red-500 text-red-700 p-4 rounded-lg mb-6">
                <ul class="list-disc list-inside text-sm">
                    @foreach ($errors->all() as $error) <li>{{ $error }}</li> @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('categories.update', $category->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                @method('PUT') <div class="grid grid-cols-1 md:grid-cols-2 gap-8">
                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Category Name</label>
                        <input type="text" name="name" value="{{ old('name', $category->name) }}"
                            class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition" required>
                    </div>

                    <div>
                        <label class="block text-sm font-bold text-slate-700 mb-2">Change Image (Optional)</label>
                        <div class="flex items-center gap-4">
                            @if($category->image)
                                <img src="{{ asset('storage/'.$category->image) }}" class="w-16 h-16 object-cover rounded-lg border">
                            @endif
                            <input type="file" name="image" accept="image/*" class="w-full text-sm text-slate-500">
                        </div>
                    </div>

                    <div class="md:col-span-2">
                        <label class="block text-sm font-bold text-slate-700 mb-2">Description</label>
                        <textarea name="description" rows="4" 
                            class="w-full border border-slate-300 rounded-xl px-4 py-3 focus:ring-4 focus:ring-blue-100 focus:border-blue-500 outline-none transition">{{ old('description', $category->description) }}</textarea>
                    </div>
                </div>

                <div class="mt-8 flex justify-end">
                    <button type="submit" class="bg-blue-600 hover:bg-blue-700 text-white font-bold py-3 px-10 rounded-xl transition-all shadow-lg shadow-blue-200">
                        Save Changes
                    </button>
                </div>
            </form>
        </div>
    </div>
</main>
@endsection