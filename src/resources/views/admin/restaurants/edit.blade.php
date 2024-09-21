@extends('admin.layouts.index')

@section('title')
    {{ __('Restaurants') }}
@endsection

@section('content')
    @include('admin.restaurants.components._form', ['method' => 'PUT', 'action' => 'admin.restaurants.update'])
@endsection
