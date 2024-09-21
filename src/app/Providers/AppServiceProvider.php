<?php

namespace App\Providers;

use App\Services\Admin\RestaurantService\RestaurantService;
use App\Services\Admin\SellerService\SellerService;
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
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
