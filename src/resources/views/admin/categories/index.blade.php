@extends('admin.layouts.index')

@section('title')
    {{ __('Categories') }}
@endsection

@section('content')
    @if(session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    @if(empty($categories))
        <div class="alert alert-warning">
            {{ __('No categories found.') }}
        </div>
    @else
        <div class="card shadow-sm custom-product-card mb-3">
            <div class="card-body">
                <div class="d-flex justify-content-between custom-table-header">
                    <h6>{{ __('All categories') }} ({{ count($categories) }})</h6>
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
                        @foreach($categories as $category)
                            <tr>
                                <td>{{ $loop->iteration }}</td>
                                <td>{{ $category['name'] }}</td>
                                <td>0</td>
                                <td>
                                    <button class="btn btn-link custom-action-btn" data-bs-toggle="modal" data-bs-target="#editModal{{ $category['id'] }}">{{ __('Edit') }}</button>
                                    <button class="btn btn-link text-danger custom-action-btn" data-bs-toggle="modal" data-bs-target="#deleteModal{{ $category['id'] }}">{{ __('Delete') }}</button>
                                    @include('admin.categories.components._edit-modal', ['category' => $category])
                                    @include('admin.categories.components._confirm', ['category' => $category])
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    @endif
    @include('admin.categories.components._form')
@endsection
