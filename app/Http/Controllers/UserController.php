<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use App\Models\ProductHistory;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class UserController extends Controller
{
    public function dashboard()
    {
        // Total Products
        $totalProducts = Product::count();

        // Total Categories
        $totalCategories = Category::count();

        // Total Users
        $totalUsers = User::count();

        // Recent Product Activities (latest 10)
        $recentActivities = ProductHistory::with('product')->orderBy('created_at', 'desc')->take(10)->get();

        // Low Stock Alerts (quantity < 5)
        $lowStockProducts = Product::where('quantity', '<', 5)->get();

        // Total Inventory Value (sum of quantity * price)
        $totalInventoryValue = Product::selectRaw('SUM(quantity * price) as total_value')->first()->total_value ?? 0;

        // Recent User Registrations (latest 10)
        $recentUsers = User::orderBy('created_at', 'desc')->paginate(10);

        return view('dashboard', compact(
            'totalProducts',
            'totalCategories',
            'totalUsers',
            'recentActivities',
            'lowStockProducts',
            'totalInventoryValue',
            'recentUsers'
        ));
    }
}
