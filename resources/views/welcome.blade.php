<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes/head')
    <title>Captivate Project Management System @yield('title')</title>
    <link href="https://fonts.googleapis.com/css?family=Reenie+Beanie" rel="stylesheet">
    <style>
        .full-btn{
            width: 100%;
        }
    </style>
</head>
<body>
    {{-- div id=app for vue components rendering. do not remove pls --}}
    <div id="app">
        <main-app></main-app>
    </div>
    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/all.js')}}"></script>
    {{-- **note : script tags must come first before end of body tag --}}
</body>
</html>