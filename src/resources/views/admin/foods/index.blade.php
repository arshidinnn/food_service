@extends('admin.layouts.index')

@section('title')
    {{ __('Foods') }}
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($foods->isEmpty())
        <div class="alert alert-warning">
            {{ __('No restaurants found.') }}
        </div>
    @else
        <div class="card shadow-sm custom-product-card">
            <div class="card-body">
                <div class="d-flex justify-content-between custom-table-header">
                    <h6>Все товары ({{ $foods->total() }})</h6>
                </div>
                <div class="table-responsive custom-table-responsive">
                    <table class="table table-hover align-middle text-center custom-dimensions-table">
                        <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>{{ __('Image') }}</th>
                            <th>{{ __('Title') }}</th>
                            <th>{{ __('Category') }}</th>
                            <th>{{ __('Price') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($foods as $index => $food)
                            <tr>
                                <td>{{ ($foods->currentPage() - 1) * $foods->perPage() + $index + 1 }}</td>

                                <td>
                                    <img src="{{ $food->image }}" alt="{{ $food->title }}"
                                         class="img-fluid custom-image" style="max-width: 100px;">
                                </td>
                                <td>{{ $food->title }}</td>
                                <td>{{ $food->category->name }}</td>
                                <td>{{ $food->price }}</td>
                                <td>
                                    @can('update', $food)
                                    <a href="{{ route('admin.foods.edit', ['food' => $food]) }}"
                                       class="btn btn-link custom-action-btn">{{ __('Edit') }}</a>
                                    @endcan

                                    @can('delete', $food)
                                        <button class="btn btn-link text-danger custom-action-btn" data-bs-toggle="modal"
                                            data-bs-target="#deleteModal{{ $food->id }}">{{ __('Delete') }}</button>
                                        @include('admin.foods.components._confirm', ['id' => $food->id])
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pagination-wrapper">
                    {{ $foods->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    @endif

    @can('create', \App\Models\Food::class)
        <div class="mt-3 custom-new-item-btn">
            <a href="{{ route('admin.foods.create') }}" class="btn btn-success">{{ __('New food') }}</a>
        </div>
    @endcan
@endsection
