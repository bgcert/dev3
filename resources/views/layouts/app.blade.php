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

    <!-- Push Scripts -->
    @stack('header-scripts')
</head>
<body>
    <div id="app">
        @include('layouts.includes.navbar')
        <el-button type="primary">Primary</el-button>

        <el-popover
		  ref="popover1"
		  placement="top-start"
		  title="Title"
		  width="200"
		  trigger="hover"
		  content="this is content, this is content, this is content">
		</el-popover>
		<el-button v-popover:popover1>Hover to activate</el-button>
        <main class="py-4">
            @yield('content')
        </main>
    </div>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}"></script>
</body>
</html>
