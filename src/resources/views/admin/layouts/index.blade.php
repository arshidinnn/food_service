<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    @stack('meta')
    <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('assets/css/style.css') }}">
    @stack('styles')
    <title>@yield('title')</title>
</head>

<body>
<div class="container-fluid">
    <div class="row">
        <!-- Sidebar -->
        @include('admin.includes.sidebar')
        <!-- Main content -->
        <main class="col-md-10 ms-sm-auto col-lg-10 px-md-4 custom-main-content">
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom custom-header">
                <h1 class="h2">@yield('title')</h1>
                <div class="btn-toolbar mb-2 mb-md-0">
                    <form action="{{ route('admin.logout') }}" method="POST" class="d-inline">
                        @csrf
                        <button type="submit" class="btn btn-outline-secondary custom-logout-btn">
                            Выйти
                        </button>
                    </form>
                </div>
            </div>
            @yield('content')
        </main>
    </div>
</div>

<script src="{{ asset('assets/js/bootstrap.bundle.min.js') }}"></script>
@stack('scripts')
</body>

</html>
