@extends('layouts.userlayout')

@section('title', $product->product_name)

@section('content')
<div class="bg-slate-100 min-h-screen py-10 px-4">
    <div class="max-w-6xl mx-auto bg-white rounded-2xl shadow-lg overflow-hidden relative">

        <!-- Back Button -->
        <a href="{{ route('user_products.index') }}"
           class="absolute top-5 right-5 flex items-center gap-2 text-sm text-blue-600 hover:text-blue-800">
            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M15 19l-7-7 7-7"/>
            </svg>
            Back
        </a>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-8 p-8">

            <!-- Image Section -->
            <div>
                <div class="overflow-hidden rounded-xl border">
                    <img
                        src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/400' }}"
                        alt="{{ $product->product_name }}"
                        class="w-full h-[420px] object-cover hover:scale-105 transition duration-300"
                    >
                </div>

                <!-- Thumbnails -->
                <div class="flex gap-3 mt-4">
                    @for ($i = 0; $i < 4; $i++)
                        <img
                            src="{{ $product->image ? asset('storage/'.$product->image) : 'https://via.placeholder.com/100' }}"
                            class="w-20 h-20 object-cover rounded-lg cursor-pointer border hover:border-blue-500 transition"
                        >
                    @endfor
                </div>
            </div>

            <!-- Product Info -->
            <div class="flex flex-col justify-between">

                <div>
                    <h1 class="text-3xl font-bold text-gray-900 mb-1">
                        {{ $product->product_name }}
                    </h1>

                    <p class="text-sm text-gray-500 mb-4">
                        SKU: {{ $product->id }}
                    </p>

                    <p class="text-2xl font-semibold text-emerald-600 mb-6">
                        ${{ number_format($product->price, 2) }}
                    </p>

                    <!-- Description -->
                    <div class="mb-6">
                        <h3 class="font-semibold text-gray-700 mb-2">Description</h3>
                        <p class="text-gray-600 leading-relaxed">
                            {{ $product->description ?? 'No description provided for this product.' }}
                        </p>
                    </div>

                    <!-- Color Options -->
                    <div>
                        <h3 class="font-semibold text-gray-700 mb-2">Color</h3>
                        <div class="flex gap-3">
                            <span class="w-7 h-7 rounded-full bg-black border-2 cursor-pointer"></span>
                            <span class="w-7 h-7 rounded-full bg-gray-300 border-2 cursor-pointer"></span>
                            <span class="w-7 h-7 rounded-full bg-blue-500 border-2 cursor-pointer"></span>
                        </div>
                    </div>
                </div>

                <!-- Action Buttons -->
                <div class="mt-8 flex gap-4">
                    <button class="flex-1 bg-blue-600 hover:bg-blue-700 text-white py-3 rounded-lg font-medium">
                        Add to Cart
                    </button>
                    <button class="px-5 py-3 border rounded-lg hover:bg-gray-100">
                        ❤
                    </button>
                </div>

            </div>
        </div>
    </div>
</div>
@endsection
