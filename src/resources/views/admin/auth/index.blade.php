@extends('admin.layouts.auth')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-5">
                <div class="card shadow-sm p-4 form-container">
                    <h3 class="text-center mb-4">{{__('Sign in')}}</h3>
                    <form action="{{ route('admin.login') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <label for="email" class="form-label">{{__('Email')}} <span class="text-danger">*</span></label>
                            <input type="text" class="form-control form-input" value="{{ old('email') }}" id="email" name="email" placeholder="{{__('Type your email')}}">
                            @error('email')
                            <div class="mt-1 form-warning">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="password" class="form-label">{{__('Password')}} <span class="text-danger">*</span></label>
                            <input type="password" class="form-control form-input" id="password" name="password" placeholder="{{ __('Type your password') }}">
                            @error('password')
                            <div class="mt-1 form-warning">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-check mb-3 d-flex align-items-center gap-2">
                            <input class="form-check-input" type="checkbox" id="remember" name="remember">
                            <label class="form-check-label pt-1" for="remember">
                                {{__('Remember me')}}
                            </label>
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-success bg-green">{{__('Sign in')}}</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
