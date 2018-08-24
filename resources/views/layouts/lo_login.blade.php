<!DOCTYPE html>
<html lang="en">
<head>
    @include('includes/head')
    <title>@yield('title') - Captivate</title>
    <style>@yield('customcss')</style>
</head>

@yield('body')

    <script src="{{asset('js/app.js')}}"></script>
    <script src="{{asset('js/all.js')}}"></script>
</html>
