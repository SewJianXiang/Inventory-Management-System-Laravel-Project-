<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;

Route::get('/', function () {
    return view('home');
});

Route::get('/stocks', [StockController::class, 'index'])->name('stocks.index');

Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');

// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);

// Product Management Routes
Route::get('/stocks', [ProductController::class, 'index'])->name('stocks.index');
Route::post('/stocks', [ProductController::class, 'store'])->name('stocks.store');

// Protected Routes
Route::middleware(['auth'])->group(function () {

    // Route::get('/stocks', function () {
    //     return view('stock');
    // })->name('stocks');

    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/inventory', function () {
        return view('inventory');
    })->name('inventory');
    
    // Admin only routes
    Route::middleware(['admin'])->group(function () {

        Route::get('/admin/dashboard', function () {
            return view('admin.dashboard');
        })->name('admin.dashboard');

        Route::get('/admin/inventory', function () {
            return view('admin.inventory');
        })->name('admin.inventory');
    });
});