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
    <!-- <meta name="viewport" content="width=device-width, initial-scale=1"> -->
    <meta name="viewport" content="width=1400">
    <meta name="description" content="Семинари365 е платформа за търсене и публикуване на курсове, семинари, обучения, зали и конферентни центрове.">
    <meta name="keywords" content="курсове, семинари, обучения, събития, зали, конферентни зали, конферентни центрове">
    <meta name="author" content="Seminari365">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - Постоянно развитие</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css" href="{{ asset('semantic-ui/semantic.min.css') }}">


    <!-- Scripts -->
    <script src="https://code.jquery.com/jquery-3.3.1.js"></script>
    <script src="{{ asset('semantic-ui/semantic.min.js') }}"></script>
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

    <!-- Push Scripts -->
    @stack('header-scripts')
</head>
<body>
	<div class="ui warning new-version message transition" style="border-radius: 0;">
		<i class="close icon"></i>
		<div class="ui container">
			<div class="header">
				Семинари365 е в процес на обновяване. Моля, пререгистрирайте Вашия акаунт.
			</div>
			<p>
				Към предишната версия <a href="http://v2.seminari365.com" target="_blank">http://v2.seminari365.com</a>.
			</p>
		</div>
	</div>
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
    	$('.ui.dropdown').dropdown();

    	$('.new-version .close')
	    	.on('click', function() {
	    		$(this)
	    		.closest('.message')
	    		.transition('fade')
	    		;
	    	})
    	;
    </script>

    <!-- Push Scripts -->
    @stack('footer-scripts')
</body>
</html>
