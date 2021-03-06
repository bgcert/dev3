<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <meta name="description" content="@yield('description', 'Seminari365.com | Платформа за публикуване на обучения и конферентни зали')">
    <meta name="keywords" content="@yield('keywords', 'курсове, семинари, обучения, събития, зали, конферентни зали, конферентни центрове')">
    <meta name="author" content="Seminari365">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title', 'Семинари365 - Постоянно развитие | Курсове, семинари, конферентни зали')</title>

    <!-- Styles -->
	@stack('canonical')
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.4.2/css/all.css" integrity="sha384-/rXc/GQVaYpyDdyxK+ecHPVYJSN9bmVFBvjA/9eOB+pb3F2w2N6fc5qB9Ew5yIns" crossorigin="anonymous">

	<!-- Favicon -->
	<link rel="apple-touch-icon" sizes="180x180" href="/apple-touch-icon.png">
	<link rel="icon" type="image/png" sizes="32x32" href="/favicon-32x32.png">
	<link rel="icon" type="image/png" sizes="16x16" href="/favicon-16x16.png">
	<link rel="manifest" href="/site.webmanifest">


    <!-- Scripts -->
    <!-- <script src="https://code.jquery.com/jquery-3.3.1.js"></script> -->
    <!-- <script async defer src="https://maps.googleapis.com/maps/api/js?key=AIzaSyB3C0jyEy5ayJpGT2xBOXp5_iN_cvi-5VU&callback=initMap"></script> -->

    <!-- Global site tag (gtag.js) - Google Analytics -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=UA-126236024-1"></script>
	<script>
		window.dataLayer = window.dataLayer || [];
		function gtag(){dataLayer.push(arguments);}
		gtag('js', new Date());

		gtag('config', 'UA-126236024-1');
	</script>

	<!-- Google map script -->
<!-- 	<script>
		function initMap() {} // now it IS a function and it is in global

		$(() => {
		  initMap = function() {
		    // your code like...
		    var map = new google.maps.Map(document.getElementById('map'), {/*your code*/});
		    // and other stuff...
		  }
		})
	</script> -->
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
	
	@auth
	<script>
	    window.user = @json(auth()->user());
	</script>

		@if(Auth::user()->role_id == 3)
			<nav class="navbar navbar-dark navbar-expand-lg bg-dark">
				<ul class="navbar-nav mr-auto">
					<li class="nav-item active">
						<a class="nav-link" href="/admin#/admin-users">Админ панел <span class="sr-only">(current)</span></a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Features</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">Pricing</a>
					</li>
					<li class="nav-item">
						<a class="nav-link" href="#">About</a>
					</li>
				</ul>
			</nav>
		@endif
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
    	$('[data-toggle="tooltip"]').tooltip({ boundary: 'window' });

    	function dropdown(e) {
    		let current = e.nextElementSibling;
    		// $('.menu-list').removeClass('active');
    		current.classList.toggle("active");
		}

    	window.onclick = function(e) {

    		if (!e.target.matches('.dropdown-btn')) {
    			$('.menu-list').removeClass('active');
    			// if ($('.menu-list').hasClass('active')) {
    			// 	$('.menu-list').toggleClass('active');
    			// }
    		}
    	}
    </script>

    @stack('footer-scripts')
</body>
</html>
