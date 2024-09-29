@extends('admin.layouts.index')

@section('title')
    {{ __('Categories') }}
@endsection

@push('meta')
    <meta name="csrf-token" content="{{ csrf_token() }}">
@endpush

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if($categories->isEmpty())
        <div class="alert alert-warning">
            {{ __('No categories found.') }}
        </div>
    @else
        <div class="card shadow-sm custom-product-card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between custom-table-header">
                    <h6>{{ __('All categories') }} ({{ $categories->total() }})</h6>
                </div>
                <div class="table-responsive custom-table-responsive">
                    <table class="table table-hover align-middle text-center custom-dimensions-table">
                        <thead class="table-light">
                        <tr>
                            <th>#</th>
                            <th>{{ __('Name') }}</th>
                            <th>{{ __('Food counts') }}</th>
                            <th>{{ __('Actions') }}</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($categories as $index => $category)
                            <tr>
                                <td>{{ ($categories->currentPage() - 1) * $categories->perPage() + $index + 1 }}</td>

                                <td>{{ $category->name }}</td>
                                <td>0</td>
                                <td>
                                    @can('update', $category)
                                        <button class="btn btn-link custom-action-btn" data-bs-toggle="modal" data-bs-target="#editModal{{ $category->id }}">{{ __('Edit') }}</button>
                                        @include('admin.categories.components._edit-modal', ['category' => $category])
                                    @endcan
                                    @can('delete', $category)
                                            <button class="btn btn-link text-danger custom-action-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $category->id }}">{{ __('Delete') }}</button>
                                            @include('admin.categories.components._confirm', ['category' => $category])
                                    @endcan
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="pagination-wrapper">
                    {{$categories->appends(request()->query())->links()}}
                </div>
            </div>
        </div>
    @endif
    @can('create', \App\Models\Category::class)
        @include('admin.categories.components._form')
    @endcan
@endsection
