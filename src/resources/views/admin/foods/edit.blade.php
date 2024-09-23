@extends('admin.layouts.index')

@section('title')
    {{ __('Edit') }}
@endsection

@section('content')
    @include('admin.foods.components._form', ['method' => 'PUT', 'action' => 'admin.foods.update'])
@endsection
