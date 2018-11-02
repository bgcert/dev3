<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
	<!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-126236024-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-126236024-1');
	</script>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Семинари365 е платформа за търсене и публикуване на курсове, семинари, обучения, зали и конферентни центрове.">
    <meta name="keywords" content="курсове, семинари, обучения, събития, зали, конферентни зали, конферентни центрове">
    <meta name="author" content="Seminari365">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Постоянно развитие</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3C0jyEy5ayJpGT2xBOXp5_iN_cvi-5VU&callback=initMap"></script> -->

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
	@stack('header-scripts')
    
</head>
<body>
	<!-- Facebook page plugin -->
    <div id="fb-root"></div>
    <script>
    	(function(d, s, id) {
	    	var js, fjs = d.getElementsByTagName(s)[0];
	    	if (d.getElementById(id)) return;
	    	js = d.createElement(s); js.id = id;
	    	js.src = 'https://connect.facebook.net/bg_BG/sdk.js#xfbml=1&version=v3.1&appId=564198150376138&autoLogAppEvents=1';
	    	fjs.parentNode.insertBefore(js, fjs);
	    }(document, 'script', 'facebook-jssdk'));
	</script>
	<!-- End Facebook page plugin -->
	
	<script>
		window.auth = @json(auth()->check());
	</script>
	@auth
	<script>
	    window.user = @json(auth()->user());
	</script>
	@endauth
    <div id="app">
    	<!-- <flash message="{{ session('flash') }}"></flash> -->
        @include('layouts.includes.navbar')

        @if(auth()->check() && !auth()->user()->verified())
        	<div class="ui container">
        		<div class="ui basic segment">
        			<div class="ui orange message">Моля, потвърдете Вашия e-mail.</div>
        		</div>
        	</div>
        @endif

        @yield('content')

        @include('layouts.includes.footer')
        
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>

    <script>
    	$(document).ready(function() {
    		$('#main-nav').click(function(e) {
    			$('.menu-list').toggleClass('active');
    		});
    	});

    	window.onclick = function(e) {
    		if (!e.target.matches('.btn')) {
    			// var myDropdown = document.getElementById("myDropdown");
    			// $('.menu-list').toggleClass('active');
    			if ($('.menu-list').hasClass('active')) {
    				$('.menu-list').toggleClass('active');
    			}
    		}
    	}
    </script>

    @stack('footer-scripts')
</body>
</html>
