<?php

use App\Http\Controllers\Admin\Auth\LoginController;
use App\Http\Controllers\Admin\Auth\LogoutController;
use App\Http\Controllers\Admin\CategoryController;
use App\Http\Controllers\Admin\RestaurantController;
use App\Http\Controllers\Admin\SellerController;
use Illuminate\Support\Facades\Route;

Route::get('/login', [LoginController::class, 'showForm'])->name('loginForm');
Route::post('/login', [LoginController::class, 'login'])->name('login');
Route::post('/logout', LogoutController::class)->name('logout')->middleware('auth');

Route::middleware('auth')->group(function() {
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
});


