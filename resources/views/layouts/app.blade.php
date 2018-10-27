<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes/head')
    <title> @yield('title') | Captivate</title>
    <style>
    .form-group label.control-label {
        margin: 2px 0 0 0;
    }
    .form-group {
        padding-bottom: 3px;
        margin: 1px 0 0 0;
    }
    .form-group .form-control {
        margin-bottom: 5px;
    }
    .form-control {
        height: 27px;
    }
    .main-main-container {
        height: 100vh;
        overflow-y: auto;
    }
    ul > li a {
        display: block !important;
    }

    @yield('customcss');
    </style>
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
    {{-- **OPO haha --}}
</body>
</html>