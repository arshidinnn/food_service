@extends('admin.layouts.index')

@section('title')
    {{ __('Restaurants') }}
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(empty($restaurants))
        <div class="alert alert-warning">
            {{ __('No restaurants found.') }}
        </div>
    @else
        <div class="card shadow-sm custom-product-card">
            <div class="card-body">
                <div class="d-flex justify-content-between custom-table-header">
                    <h6>{{ __('All Restaurants') }} ({{ count($restaurants) }})</h6>
                </div>
                <div class="table-responsive custom-table-responsive">
                    <table class="table table-hover align-middle text-center custom-dimensions-table">
                        <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>{{ __('Image') }}</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($restaurants as $restaurant)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>
                                    <img src="{{ $restaurant['image'] }}" alt="{{ $restaurant['name'] }}" class="img-fluid custom-image" style="max-width: 100px;">
                                </td>
                                <td>{{ $restaurant['name'] }}</td>
                                <td>
                                    <a href="{{ route('admin.restaurants.edit', ['restaurant' => $restaurant['id']]) }}" class="btn btn-link custom-action-btn">{{ __('Edit') }}</a>
                                    <button class="btn btn-link text-danger custom-action-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $restaurant['id'] }}">{{ __('Delete') }}</button>
                                    @include('admin.restaurants.components._confirm', ['id' => $restaurant['id']])
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif

    <div class="mt-3 custom-new-item-btn">
        <a href="{{ route('admin.restaurants.create') }}" class="btn btn-success">{{ __('New restaurant') }}</a>
    </div>

@endsection
