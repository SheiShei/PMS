<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes/head')
    <title>Captivate | @yield('title')</title>
    @yield('customcss')
</head>
<body>
    @include('includes/sidebar')
    @include('includes/topnav')
    {{-- div id=app for vue components rendering. do not remove pls --}}
    <div id="app">
        @yield('content')
    </div>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/all.js')}}"></script>
    @yield('customjs')
    {{-- **note : script tags must come first before end of body tag --}}
</body>
</html>