@extends('layouts.userlayout')

@section('title', 'Categories')

@section('content')
<div class="bg-slate-100 min-h-screen py-10 px-4">

    <div class="max-w-7xl mx-auto">
        <h1 class="text-2xl font-bold mb-6 text-gray-800">
            Browse Categories
        </h1>

        <!-- Category Grid -->
        <div class="grid grid-cols-2 sm:grid-cols-3 md:grid-cols-4 lg:grid-cols-6 gap-6">

            @foreach($categories as $category)
                <a href="{{ route('user_products.index', ['category_name' => $category->name]) }}"
                    class="group relative bg-white rounded-xl shadow-sm hover:shadow-lg transition-all transform hover:scale-105 overflow-hidden">
                    
                    <!-- Image with gradient overlay -->
                    <div class="aspect-square overflow-hidden relative">
                        <img src="{{ $category->image ? asset('storage/'.$category->image) : 'https://via.placeholder.com/300' }}"
                                alt="{{ $category->name }}"
                                class="w-full h-full object-cover rounded-xl transition duration-300 group-hover:scale-105">
                        <div class="absolute inset-0 bg-gradient-to-t from-black/20 to-transparent opacity-0 group-hover:opacity-50 transition"></div>
                    </div>

                    <!-- Label -->
                    <div class="p-3 text-center">
                        <p class="text-sm font-medium text-gray-700 group-hover:text-white
                                    bg-gray-100 group-hover:bg-blue-600 rounded-full px-2 py-1 inline-block transition">
                            {{ $category->name }}
                        </p>
                    </div>
                    </a>
            @endforeach

        </div>
    </div>
</div>
@endsection
