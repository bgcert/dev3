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
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3C0jyEy5ayJpGT2xBOXp5_iN_cvi-5VU&callback=initMap"
	type="text/javascript"></script>

	<!-- Google map script -->
	<script>
		function initMap() {} // now it IS a function and it is in global

		$(() => {
		  initMap = function() {
		    // your code like...
		    var map = new google.maps.Map(document.getElementById('map'), {/*your code*/});
		    // and other stuff...
		  }
		})
	</script>

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
