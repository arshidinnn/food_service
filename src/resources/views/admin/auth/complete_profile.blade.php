@extends('admin.layouts.auth')

@section('title', __('Finish profile settings'))

@section('content')
    <h3 class="text-center mb-4">{{ __('Finish profile settings') }}</h3>

    <form action="{{ route('admin.settings.finish') }}" method="POST">
        @csrf
        @method('PUT')
        <div class="mb-3">
            <label for="first-name" class="form-label">{{ __('FirstName') }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-input" id="first-name" name="first_name" value="{{ old('first_name') }}" placeholder="{{ __('Enter your firstname') }}">
            @error('first_name')
            <div class="form-warning">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="last-name" class="form-label">{{ __('LastName') }} <span class="text-danger">*</span></label>
            <input type="text" class="form-control form-input" id="last-name" name="last_name" value="{{ old('last_name') }}" placeholder="{{ __('Enter your lastname') }}">
            @error('last_name')
            <div class="form-warning">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password" class="form-label">{{ __('New password') }} <span class="text-danger">*</span></label>
            <input type="password" class="form-control form-input" id="password" name="password" placeholder="{{ __('Type your new password') }}">
            @error('password')
            <div class="form-warning">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="password-confirmation" class="form-label">{{ __('Confirm new password') }} <span class="text-danger">*</span></label>
            <input type="password" class="form-control form-input" id="password-confirmation" name="password_confirmation" placeholder="{{ __('Confirm your new password') }}">
        </div>

        <div class="d-grid">
            <button type="submit" class="btn btn-success bg-green">{{ __('Save') }}</button>
        </div>
    </form>
@endsection
