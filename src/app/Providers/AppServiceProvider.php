<?php

namespace App\Providers;

use App\Models\Category;
use App\Models\Restaurant;
use App\Models\Seller;
use App\Policies\CategoryPolicy;
use App\Policies\RestaurantPolicy;
use App\Policies\SellerPolicy;
use App\Services\Admin\FoodService\FoodService;
use App\Services\Admin\NotificationService;
use App\Services\Admin\RestaurantService\RestaurantService;
use App\Services\Admin\SellerService\SellerService;
use App\Services\Admin\StorageService;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Gate;
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
        $this->app->bind(NotificationService::class, NotificationService::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrap();

//        Gate::policy(Seller::class, SellerPolicy::class);
//        Gate::policy(Restaurant::class, RestaurantPolicy::class);
//        Gate::policy(Category::class, CategoryPolicy::class);
    }
}
