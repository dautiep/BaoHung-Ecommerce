<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="{{asset('admin/images/favicon.png')}}" rel="shortcut icon" type="image/x-icon" />
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    @include('admin.layouts.includes.styles')

    <!-- Custom Styles -->
    @yield('styles')

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}

    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet"> --}}

    <!-- Styles -->
    {{-- <link href="{{ asset('css/app.css') }}" rel="stylesheet"> --}}
</head>
<body class="@if(Auth::check()) hold-transition sidebar-mini layout-fixed @else hold-transition login-page @endif">
    <!-- Pre-loader -->
    @include('admin.layouts.includes.pre_loader')

    @if(Auth::check())
        <div class="wrapper">
            <!-- Header (S) -->
            @include('admin.layouts.includes.header')
            <!-- Left Sidebar (S) -->
            @include('admin.layouts.includes.left_sidebar')
            <!-- Content (S) -->
            <div class="content-wrapper" style="min-height: 214px">
                @yield('content')
            </div>
            <!-- Footer (S) -->
            @include('admin.layouts.includes.footer')
        </div>

        <!-- js -->
        @include('admin.layouts.includes.scripts')
        <!-- Custom JS -->
        @yield('scripts')
    @else

        @yield('content')
        @yield('scripts')
    @endif
</body>
</html>
