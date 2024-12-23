<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Controllers\Admin\Auth\ProfileCompletionController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\FoodController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\SellerController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'showForm'])->name('loginForm')->middleware('guest');
Route::post('/login', [LoginController::class, 'login'])->name('login')->middleware('guest');
Route::post('/logout', LogoutController::class)->name('logout')->middleware('auth');

Route::middleware(['auth', 'profile.incomplete'])
    ->withoutMiddleware('profile.complete')
    ->group(function() {
        Route::get('/finish-profile', [ProfileCompletionController::class, 'index'])->name('settings.form');
        Route::put('/finish-profile', [ProfileCompletionController::class, 'update'])->name('settings.finish');
    });

Route::middleware(['auth', 'profile.complete'])->group(function() {
    Route::view('/', 'admin.dashboard.index')->name('dashboard');

    Route::prefix('/sellers')
        ->name('sellers.')
        ->group(function() {
            Route::get('/', [SellerController::class, 'index'])->name('index');
            Route::get('/create', [SellerController::class, 'create'])->name('create');
            Route::post('/', [SellerController::class, 'store'])->name('store');
            Route::get('/{seller}/edit', [SellerController::class, 'edit'])->name('edit');
            Route::put('/{seller}', [SellerController::class, 'update'])->name('update');
            Route::delete('/{seller}', [SellerController::class, 'destroy'])->name('destroy');
        });

    Route::prefix('/restaurants')
        ->name('restaurants.')
        ->group(function() {
            Route::get('/', [RestaurantController::class, 'index'])->name('index');
            Route::get('/create', [RestaurantController::class, 'create'])->name('create');
            Route::post('/', [RestaurantController::class, 'store'])->name('store');
            Route::get('/{restaurant}/edit', [RestaurantController::class, 'edit'])->name('edit');
            Route::put('/{restaurant}', [RestaurantController::class, 'update'])->name('update');
            Route::delete('/{restaurant}', [RestaurantController::class, 'destroy'])->name('destroy');
        });

    Route::prefix('categories')
        ->name('categories.')
        ->group(function() {
            Route::get('/', [CategoryController::class, 'index'])->name('index');
            Route::post('/', [CategoryController::class, 'store'])->name('store');
            Route::put('/{category}', [CategoryController::class, 'update'])->name('update');
            Route::delete('/{category}', [CategoryController::class, 'destroy'])->name('destroy');
        });

    Route::prefix('foods')
        ->name('foods.')
        ->group(function() {
            Route::get('/', [FoodController::class, 'index'])->name('index');
            Route::get('/create', [FoodController::class, 'create'])->name('create');
            Route::post('/', [FoodController::class, 'store'])->name('store');
            Route::get('/{food}', [FoodController::class, 'show'])->name('show');
            Route::get('/{food}/edit', [FoodController::class, 'edit'])->name('edit');
            Route::put('/{food}', [FoodController::class, 'update'])->name('update');
            Route::delete('/{food}', [FoodController::class, 'destroy'])->name('destroy');
        });
});


