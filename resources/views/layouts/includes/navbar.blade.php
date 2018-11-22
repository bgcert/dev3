<nav class="navbar sticky-top navbar-light bg-light navbar-expand-lg">
	<a class="navbar-brand" href="/">
		<img src="/img/logo-s365.png" alt="{{ config('app.name', 'Laravel') }}">
	</a>

	<button
		class="navbar-toggler"
		type="button"
		data-toggle="collapse"
		data-target="#navbarSupportedContent"
		aria-controls="navbarSupportedContent"
		aria-expanded="false"
		aria-label="Toggle navigation">

		<span class="navbar-toggler-icon"></span>
	</button>

	<div class="collapse navbar-collapse" id="navbarSupportedContent">
		<ul class="navbar-nav mr-auto">
			<li class="nav-item active">
				<a class="nav-link" href="/browse">Обучения <span class="sr-only">(current)</span></a>
			</li>
			<li class="nav-item">
				<a class="nav-link" href="/v">Зали</a>
			</li>
		</ul>

		<ul class="navbar-nav ml-auto d-flex align-items-center">
			<li class="nav-item">
				<search></search>
			</li>
			@guest
			<li class="nav-item">
				<button class="btn btn-link" @click="callRegister">Регистрация</button>
				<register-modal></register-modal>
			</li>
			<li>
				<button class="btn btn-primary btn-lg btn-round mx-2" @click="callLogin">Вход</button>
				<login-modal></login-modal>
			</li>

			@else

			@if(Auth::user()->role_id == 2)
			<li>
				<a class="btn btn-warning mx-3" href="/dashboard#/profile">Бизнес панел</a>
			</li>
			@endif

			<li class="nav-item dropdown mx-3">
				<button class="btn btn-outline-secondary btn-round" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					{{ Auth::user()->abbr }}
				</button>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="/users/settings#/settings"> Акаунт</a>
					<div class="dropdown-divider"></div>
					<a
						class="dropdown-item"
						href="{{ route('logout') }}"
						onclick="event.preventDefault();
								document.getElementById('logout-form').submit();">
						Изход
					</a>
				</div>

				<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
					@csrf
				</form>
			</li>

			@endguest

			<li class="nav-item dropdown mx-3">
				<button class="btn btn-outline-primary btn-icon btn-sm btn-circle" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<i class="fas fa-question"></i>
				</button>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="/page/help">Помощ</a>
					<a class="dropdown-item" href="/page/report">Докладване</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="/page/contact">Контакти</a>
				</div>
			</li>

			<li class="nav-item mx-3">
				<a href="/users/settings#/notifications" class="btn btn-outline-primary btn-icon btn-sm btn-circle">
					<i class="far fa-bell"></i>
				</a>
			</li>
		</ul>
	</div>
</nav>