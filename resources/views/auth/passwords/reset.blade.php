@extends('layouts.app')

@section('content')

<div class="ui container">
	<div class="ui two column centered grid mt-20">
		<div class="column">
			<h2>Забравена парола</h2>
			<div class="ui very padded segment">
				@if (session('status'))
                    <div class="ui warning message">
                        {{ session('status') }}
                    </div>
                @endif
				<form class="ui form" method="POST" action="{{ route('password.request') }}">
					@csrf

					<input type="hidden" name="token" value="{{ $token }}">
					<div class="field">
						<label>E-mail</label>
						<input id="email" type="email" name="email" value="{{ $email or old('email') }}" required autofocus>
					</div>

					<div class="field">
						<label>Парола</label>
						<input type="password" name="password" required>
					</div>

					<div class="field">
						<label>Повторете паролата</label>
						<input id="password-confirm" type="password" name="password_confirmation" required>
					</div>

					<button class="ui primary button" type="submit">Промяна на паролата</button>
				</form>
			</div>
		</div>
	</div>
</div>

@endsection
