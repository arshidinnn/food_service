@extends('admin.layouts.index')

@section('title')
    {{ __('Sellers') }}
@endsection

@section('content')
    @include('admin.sellers.components._form', ['method' => 'PUT', 'action' => 'admin.sellers.update', 'seller' => $seller])
@endsection
