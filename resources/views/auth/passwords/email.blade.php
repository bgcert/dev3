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
				<form class="ui form" method="POST" action="{{ route('password.email') }}">
					@csrf
					<div class="field">
						<label>Въведете e-mail адресът, отговарящ на Вашия акаунт:</label>
						<input type="email" name="email" required>
					</div>
					<button class="ui primary button" type="submit">Изпрати линк за промяна на паролата</button>
				</form>
			</div>
		</div>
	</div>
</div>
@endsection
