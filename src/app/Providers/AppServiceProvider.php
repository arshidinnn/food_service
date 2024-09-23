<?php

namespace App\Providers;

use App\Services\Admin\FoodService\FoodService;
use App\Services\Admin\RestaurantService\RestaurantService;
use App\Services\Admin\SellerService\SellerService;
use App\Services\Admin\StorageService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(SellerService::class, SellerService::class);
        $this->app->bind(RestaurantService::class, RestaurantService::class);
        $this->app->bind(SellerService::class, SellerService::class);
        $this->app->bind(FoodService::class, FoodService::class);

        $this->app->bind(StorageService::class, StorageService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
