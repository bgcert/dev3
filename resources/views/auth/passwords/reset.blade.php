@extends('layouts.app')

@section('content')

<div class="container tiny mtop">
	<h2>Забравена парола</h2>
	<div>
		@if (session('status'))
            <div class="ui warning message">
                {{ session('status') }}
            </div>
        @endif
		<form class="ui form" method="POST" action="{{ route('password.request') }}">
			@csrf

			<input type="hidden" name="token" value="{{ $token }}">
			<div class="field">
				<input id="email" type="email" name="email" value="{{ $email or old('email') }}" placeholder="E-mail" required autofocus>
			</div>

			<div class="field">
				<input type="password" name="password" placeholder="Парола" required>
			</div>

			<div class="field">
				<input id="password-confirm" type="password" name="password_confirmation" placeholder="Повторете паролата" required>
			</div>

			<button class="btn blue" type="submit">Промяна на паролата</button>
		</form>
	</div>
</div>

@endsection
