<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes/head')
    <title>@yield('title')</title>
</head>

<body style="max-height:100vh; background-color:whitesmoke">
    @include('includes/nav')
    @yield('content')
    {{-- @include('includes/footer') --}}
</body>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/all.js')}}"></script>
</html>