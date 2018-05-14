<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">

    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.2.1.js"></script>

    <!-- Push Scripts -->
    @stack('header-scripts')
</head>
<body>
    <div id="app">
    	<!-- <flash message="{{ session('flash') }}"></flash> -->
        @include('layouts.includes.navbar')

        @yield('content')
        
        <main class="py-4">
            
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
    	$('.ui.dropdown').dropdown();
    </script>

    <!-- Push Scripts -->
    @stack('footer-scripts')
</body>
</html>
