@extends('layouts.app')

@push('header-scripts')
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1';
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>

<!-- Your customer chat code -->
<div class="fb-customerchat"
	attribution=setup_tool
	page_id="149145054051"
	theme_color="#ff7e29"
	logged_in_greeting="Здравейте! Как можем да Ви помогнем?"
	logged_out_greeting="Здравейте! Как можем да Ви помогнем?">
</div>
@endpush

@section('content')

<div class="ui container">
	<div class="ui segment mt-20">
		Помощ
	</div>
</div>
@endsection