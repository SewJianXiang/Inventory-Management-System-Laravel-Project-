<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\StockController;
use App\Http\Controllers\Auth\LoginController;
use App\Http\Controllers\Auth\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;

Route::get('/', function () {
    return view('home');
});





// Authentication Routes
Route::get('/login', [LoginController::class, 'showLoginForm'])->name('login');
Route::post('/login', [LoginController::class, 'login']);
Route::post('/logout', [LoginController::class, 'logout'])->name('logout');

Route::get('/register', [RegisterController::class, 'showRegistrationForm'])->name('register');
Route::post('/register', [RegisterController::class, 'register']);




// Product Management Routes
// Protected Routes
Route::middleware(['auth'])->group(function () {
    // Put static history routes before dynamic product routes so '/products/history' isn't captured as a product id
    Route::get('/products/history', [ProductController::class, 'histories'])->name('products.histories');
    Route::get('/products/{product}/history', [ProductController::class, 'history'])->name('products.history');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('products.destroy');

    // User products route
    Route::get('/user/user_product', [ProductController::class, 'user_index'])->name('user_products.index');
    
    // User-specific category show route
    Route::get('/user/categories', [CategoryController::class, 'user_categoryIndex'])->name('user_categories.index');
    
    // User-specific product show route
    Route::get('/products/{id}/user_show', [ProductController::class, 'user_show'])->name('products.user_show');

    // Constrain product show to numeric ids to avoid collisions with named routes
    Route::get('/products/{id}', [ProductController::class, 'show'])->name('products.show');


    // Stock and Category Routes
    Route::get('/stocks', [ProductController::class, 'index'])->name('stocks.index');
    Route::post('/stocks', [ProductController::class, 'store'])->name('stocks.store');
    
    Route::get('/categories', [CategoryController::class, 'index'])->name('categories.index');
    Route::post('/categories', [CategoryController::class, 'store'])->name('categories.store');
    Route::delete('/categories/{id}', [CategoryController::class, 'destroy'])->name('categories.destroy');
    
    Route::get('/settings/password', [App\Http\Controllers\SettingsController::class, 'editPassword'])->name('settings.password');
    Route::post('/settings/password', [App\Http\Controllers\SettingsController::class, 'updatePassword'])->name('settings.password.update');

    Route::get('/user/user_settings/password', [App\Http\Controllers\SettingsController::class, 'user_editPassword'])->name('user.settings.password');
    Route::post('/user/user_settings/password', [App\Http\Controllers\SettingsController::class, 'updatePassword'])->name('user.settings.password.update');


    Route::get('/dashboard', function () {
        return view('dashboard');
    })->name('dashboard');

    Route::get('/inventory', function () {
        return view('inventory');
    })->name('inventory');
    
    // Edit And Delete Routes
    Route::put('/products/{product}', [ProductController::class, 'update'])
     ->name('products.update');

    Route::delete('/products/{product}', [ProductController::class, 'destroy'])
     ->name('products.destroy');

    // Admin only routes
    Route::middleware(['admin'])->group(function () {

        Route::get('/admin/dashboard', [AdminController::class, 'dashboard'])->name('admin.dashboard');

        Route::get('/admin/inventory', function () {
            return view('admin.inventory');
        })->name('admin.inventory');
    });
});