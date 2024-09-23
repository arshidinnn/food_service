@extends('admin.layouts.index')

@section('title')
    {{ __('Create') }}
@endsection

@section('content')
    @include('admin.foods.components._form', ['method' => 'POST', 'action' => 'admin.foods.store'])
@endsection
