<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes/head')
    <title>@yield('title')</title>
    <style>@yield('customcss')</style>
</head>

<body>
    @include('includes/sidebar')
    @include('includes/topnav')
    @yield('content')
    {{-- @include('includes/footer') --}}
</body>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/all.js')}}"></script>
</html>