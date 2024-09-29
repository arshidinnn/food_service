<nav class="col-md-2 d-none d-md-block bg-blue sidebar vh-100 sticky-top">
    <div class="logo p-4 text-center">FOOD</div>
    <div class="position-sticky sticky-top">
        <ul class="nav nav-list flex-column text-white">
            @can('anyActions', \App\Models\Seller::class)
                <li class="nav-item">
                    <a class="nav-link link-item text-white active" href="{{ route('admin.sellers.index') }}">
                        {{ __('Sellers') }}
                    </a>
                </li>
            @endcan

            @can('viewAny', \App\Models\Restaurant::class)
                <li class="nav-item">
                    <a class="nav-link link-item text-white active" href="{{ route('admin.restaurants.index') }}">
                        {{ __('Restaurants') }}
                    </a>
                </li>
            @endcan

            @can('viewAny', \App\Models\Category::class)
                <li class="nav-item">
                    <a class="nav-link link-item text-white active" href="{{ route('admin.categories.index') }}">
                        {{ __('Categories') }}
                    </a>
                </li>
            @endcan

            <li class="nav-item">
                <a class="nav-link link-item text-white active" href="{{ route('admin.foods.index') }}">
                    {{ __('Foods') }}
                </a>
            </li>


        </ul>
    </div>
</nav>
