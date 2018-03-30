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

    <link href='https://fonts.googleapis.com/css?family=Roboto:300,400,500,700|Material+Icons' rel="stylesheet">
	<link href="https://unpkg.com/vuetify/dist/vuetify.min.css" rel="stylesheet">
	<meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no, minimal-ui">


</head>
<body>
	<div id="app">
		<v-app>
			<v-toolbar>
				<v-toolbar-side-icon></v-toolbar-side-icon>
				<v-toolbar-title>Title</v-toolbar-title>
				<v-spacer></v-spacer>
				<v-toolbar-items class="hidden-sm-and-down">
					<v-btn flat>Link One</v-btn>
					<v-btn flat>Link Two</v-btn>
					<v-btn flat>Link Three</v-btn>
				</v-toolbar-items>
			</v-toolbar>
			<card></card>
		</v-app>
	</div>
	<h4>test</h4>
	<script src="{{ asset('js/app.js') }}"></script>
	<script src="https://unpkg.com/vue/dist/vue.js"></script>
	<script src="https://unpkg.com/vuetify/dist/vuetify.js"></script>

</body>
</html>

