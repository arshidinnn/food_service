@extends('admin.layouts.index')

@section('title')
    {{ __('Sellers') }}
@endsection

@section('content')

    <div class="card shadow-sm custom-product-card">
        <div class="card-body">
            <div class="d-flex justify-content-between custom-table-header">
                <h6>{{ __('All Sellers') }} ({{ count($sellers)  }})</h6>
            </div>
            <div class="table-responsive custom-table-responsive">
                <table class="table table-hover align-middle text-center custom-dimensions-table">
                    <thead class="table-light">
                    <tr>
                        <th>#</th>
                        <th>{{ __('Name') }}</th>
                        <th>{{ __('BIN') }}</th>
                        <th>{{ __('Regular number') }}</th>
                        <th>{{ __('Email') }}</th>
                        <th>{{ __('Temporary Password') }}</th>
                        <th>{{ __('Actions') }}</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($sellers as $seller)
                        <tr>
                            <td>{{ $seller['id']}}</td>
                            <td>{{ $seller['name'] }}</td>
                            <td>{{ $seller['bin'] }}</td>
                            <td>{{ $seller['reg_number']}}</td>
                            <td>{{ $seller['email'] }}</td>
                            <td>{{ $seller['temporary_password'] ?? '-' }}</td>
                            <td>
                                <a href="{{ route('admin.sellers.edit', ['seller' => $seller['id']] ) }}" class="btn btn-link custom-action-btn">{{ __('Edit') }}</a>
                                <form action="#" method="POST" style="display:inline;">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="btn btn-link text-danger custom-action-btn">{{ __('Delete') }}</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <div class="mt-3 custom-new-item-btn">
        <a href="{{ route('admin.sellers.create') }}" class="btn btn-success">{{ __('New seller') }}</a>
    </div>
@endsection
