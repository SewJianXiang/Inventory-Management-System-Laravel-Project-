@extends('layouts.userlayout')

@section('title', 'StockSys Malaysia')

@section('content')
<div class="container mx-auto px-4 py-6">
    <h1 class="text-2xl font-bold mb-6">User Dashboard</h1>

    <!-- Overview Cards -->
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
        <!-- Total Products -->
        <div class="bg-gradient-to-br from-blue-50 to-blue-100 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-blue-200">
            <div class="flex items-center justify-between mb-3">
                <div class="bg-blue-500 p-2 rounded-full">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M3 4a1 1 0 011-1h12a1 1 0 011 1v2a1 1 0 01-1 1H4a1 1 0 01-1-1V4zM3 10a1 1 0 011-1h6a1 1 0 011 1v6a1 1 0 01-1 1H4a1 1 0 01-1-1v-6zM14 9a1 1 0 00-1 1v6a1 1 0 001 1h2a1 1 0 001-1v-6a1 1 0 00-1-1h-2z"></path>
                    </svg>
                </div>
                <div class="text-blue-600">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <h2 class="text-lg font-semibold text-gray-800 mb-1">Total Products</h2>
            <p class="text-3xl font-bold text-blue-600">{{ $totalProducts }}</p>
        </div>

        <!-- Total Categories -->
        <div class="bg-gradient-to-br from-green-50 to-green-100 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-green-200">
            <div class="flex items-center justify-between mb-3">
                <div class="bg-green-500 p-2 rounded-full">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M7 3a1 1 0 000 2h6a1 1 0 100-2H7zM4 7a1 1 0 011-1h10a1 1 0 110 2H5a1 1 0 01-1-1zM2 11a2 2 0 012-2h12a2 2 0 012 2v4a2 2 0 01-2 2H4a2 2 0 01-2-2v-4z"></path>
                    </svg>
                </div>
                <div class="text-green-600">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <h2 class="text-lg font-semibold text-gray-800 mb-1">Total Categories</h2>
            <p class="text-3xl font-bold text-green-600">{{ $totalCategories }}</p>
        </div>

        <!-- Total Users -->
        <div class="bg-gradient-to-br from-purple-50 to-purple-100 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-purple-200">
            <div class="flex items-center justify-between mb-3">
                <div class="bg-purple-500 p-2 rounded-full">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 6a3 3 0 11-6 0 3 3 0 016 0zM17 6a3 3 0 11-6 0 3 3 0 016 0zM12.93 17c.046-.327.07-.66.07-1a6.97 6.97 0 00-1.5-4.33A5 5 0 0119 16v1h-6.07zM6 11a5 5 0 015 5v1H1v-1a5 5 0 015-5z"></path>
                    </svg>
                </div>
                <div class="text-purple-600">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <h2 class="text-lg font-semibold text-gray-800 mb-1">Total Users</h2>
            <p class="text-3xl font-bold text-purple-600">{{ $totalUsers }}</p>
        </div>

        <!-- Total Inventory Value -->
        <div class="bg-gradient-to-br from-red-50 to-red-100 p-6 rounded-xl shadow-lg hover:shadow-xl transition-all duration-300 transform hover:-translate-y-1 border border-red-200">
            <div class="flex items-center justify-between mb-3">
                <div class="bg-red-500 p-2 rounded-full">
                    <svg class="w-6 h-6 text-white" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M4 4a2 2 0 00-2 2v4a2 2 0 002 2V6h10a2 2 0 00-2-2H4zm2 6a2 2 0 012-2h8a2 2 0 012 2v4a2 2 0 01-2 2H8a2 2 0 01-2-2v-4zm6 4a2 2 0 100-4 2 2 0 000 4z"></path>
                    </svg>
                </div>
                <div class="text-red-600">
                    <svg class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20">
                        <path d="M9 12l2 2 4-4m6 2a9 9 0 11-18 0 9 9 0 0118 0z"></path>
                    </svg>
                </div>
            </div>
            <h2 class="text-lg font-semibold text-gray-800 mb-1">Total Inventory Value</h2>
            <p class="text-3xl font-bold text-red-600">${{ number_format($totalInventoryValue, 2) }}</p>
        </div>
    </div>

    <!-- Recent Activities and Low Stock -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mb-8">
        <!-- Recent Product Activities -->
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center mb-4">
                <div class="bg-blue-100 p-2 rounded-full mr-3">
                    <svg class="w-5 h-5 text-blue-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-800">Recent Product Activities</h2>
            </div>
            <div class="space-y-3">
                @forelse($recentActivities as $activity)
                    <div class="border-l-4 border-blue-500 pl-3 py-2 bg-gray-50 rounded-r-lg">
                        <p class="text-xs text-gray-600 mb-1">{{ $activity->created_at->format('M d, Y H:i') }}</p>
                        <p class="font-medium text-gray-800 text-sm">{{ $activity->user_name }} {{ $activity->action }} product "{{ $activity->product->product_name ?? 'N/A' }}"</p>
                    </div>
                @empty
                    <div class="text-center py-6">
                        <svg class="w-12 h-12 text-gray-300 mx-auto mb-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm1-12a1 1 0 10-2 0v4a1 1 0 00.293.707l2.828 2.829a1 1 0 101.415-1.415L11 9.586V6z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-gray-500 text-base">No recent activities.</p>
                    </div>
                @endforelse
            </div>
        </div>

        <!-- Low Stock Alerts -->
        <div class="bg-white p-6 rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300">
            <div class="flex items-center mb-4">
                <div class="bg-red-100 p-2 rounded-full mr-3">
                    <svg class="w-5 h-5 text-red-600" fill="currentColor" viewBox="0 0 20 20">
                        <path fill-rule="evenodd" d="M8.257 3.099c.765-1.36 2.722-1.36 3.486 0l5.58 9.92c.75 1.334-.213 2.98-1.742 2.98H4.42c-1.53 0-2.493-1.646-1.743-2.98l5.58-9.92zM11 13a1 1 0 11-2 0 1 1 0 012 0zm-1-8a1 1 0 00-1 1v3a1 1 0 002 0V6a1 1 0 00-1-1z" clip-rule="evenodd"></path>
                    </svg>
                </div>
                <h2 class="text-xl font-semibold text-gray-800">Low Stock Alerts</h2>
            </div>
            <div class="space-y-3">
                @forelse($lowStockProducts as $product)
                    <div class="border-l-4 border-red-500 pl-3 py-2 bg-red-50 rounded-r-lg">
                        <p class="font-semibold text-gray-800 text-sm">{{ $product->product_name }}</p>
                        <p class="text-xs text-red-600 font-medium">Quantity: {{ $product->quantity }}</p>
                    </div>
                @empty
                    <div class="text-center py-6">
                        <svg class="w-12 h-12 text-green-300 mx-auto mb-3" fill="currentColor" viewBox="0 0 20 20">
                            <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd"></path>
                        </svg>
                        <p class="text-gray-500 text-base">No low stock items.</p>
                    </div>
                @endforelse
            </div>
        </div>
    </div>

    <!-- Recent User Registrations -->
    <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mt-6 items-stretch">

    <!-- Add Product -->
    <a href="{{ route('user_products.index') }}"
       class="bg-blue-500 text-white p-6 rounded-xl shadow-lg
              hover:scale-105 hover:bg-blue-600 transition
              flex flex-col justify-between h-full">

        <div class="flex flex-col items-center text-center">
            <div class="bg-blue-700 p-4 rounded-full shadow mb-4">
                <!-- Box Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M20 13V7a2 2 0 00-2-2h-3M4 7v6m16 0l-8 4-8-4m16 0l-8-4-8 4"/>
                </svg>
            </div>

            <div class="font-bold text-lg flex items-center gap-2">
                Review Products
            </div>

            <p class="text-sm text-blue-100 mt-2">
                Browse and review the latest products added to the inventory.
            </p>
        </div>
    </a>

    <!-- Create Order -->
    <a href="{{ route('user_categories.index') }}"
       class="bg-green-500 text-white p-6 rounded-xl shadow-lg
              hover:scale-105 hover:bg-green-600 transition
              flex flex-col justify-between h-full">

        <div class="flex flex-col items-center text-center">
            <div class="bg-green-700 p-4 rounded-full shadow mb-4">
                <!-- Document Icon -->
                <svg xmlns="http://www.w3.org/2000/svg" class="h-10 w-10" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                          d="M9 12h6m-6 4h6m2 4H7a2 2 0 01-2-2V6a2 2 0 012-2h5l5 5v11a2 2 0 01-2 2z"/>
                </svg>
            </div>

            <div class="font-bold text-lg flex items-center gap-2">
                Review Categories
            </div>

            <p class="text-sm text-green-100 mt-2">
                Browse and review the latest categories added to the inventory.
            </p>
        </div>
    </a>

</div>
            
        

    
</div>
@endsection
