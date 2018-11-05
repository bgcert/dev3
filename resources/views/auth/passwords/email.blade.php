@extends('layouts.app')

@section('content')
<div class="container tiny">
	<h2>Забравена парола</h2>
	<div class="ui very padded segment">
		@if (session('status'))
            <div class="ui warning message">
                {{ session('status') }}
            </div>
        @endif
		<form class="ui form" method="POST" action="{{ route('password.email') }}">
			@csrf
			<div class="field">
				Въведете e-mail адресът, отговарящ на Вашия акаунт:
			</div>
			<div class="field">
				<input type="email" name="email" required>
			</div>
			<button class="btn blue" type="submit">Изпрати линк за промяна на паролата</button>
		</form>
	</div>
</div>
@endsection
