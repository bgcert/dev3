<nav class="navbar navbar-light bg-light navbar-expand-lg">
	<a class="navbar-brand" href="/">
		<img src="/img/logo-s365.png" alt="{{ config('app.name', 'Laravel') }}">
	</a>
	<button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
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

		<ul class="navbar-nav ml-auto">
			<li class="nav-item">
				<form class="form-inline">
					<input class="form-control mr-sm-2" type="search" placeholder="Search" aria-label="Search">
					<button class="btn btn-outline-success" type="submit">Search</button>
				</form>
			</li>

			@guest
			<li>
				<register-modal></register-modal>
			</li>
			<li>
				<login-modal></login-modal>
			</li>
			@endguest

			<li class="nav-item dropdown">
				<button class="btn btn-icon" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
					<span class="oi oi-question-mark"></span>
				</button>
				<div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
					<a class="dropdown-item" href="#">Action</a>
					<a class="dropdown-item" href="#">Another action</a>
					<div class="dropdown-divider"></div>
					<a class="dropdown-item" href="#">Something else here</a>
				</div>
			</li>
		</ul>
	</div>
</nav>


<!-- END BOOTSTRAP -->
<div class="container">
	<nav>
		<div class="container aligned">
			<ul class="aligned upercase">
				<li>
					<a href="/" class="logo">
						<img src="/img/logo-s365.png">
					</a>	
				</li>
				<li><a href="/browse">Обучения</a></li>
				<li><a href="/v">Зали</a></li>
			</ul>

			<ul class="aligned">
				<li>
					<search></search>
				</li>

				<li>
					<div class="dropdown">
						<a href="#" id="main-nav" class="dropdown-btn" onclick="dropdown(this)">
							<i class="far fa-question-circle"></i>
						</a>
						<div class="menu-list">
							<a href="/page/help">Помощ</a>
							<a href="/page/report">Докладване</a>
							<a href="/page/contact">Контакти</a>
						</div>
					</div>
				</li>
				@guest
				<li><register-modal></register-modal></li>
				<li><login-modal></login-modal></li>
				@else

				@if(Auth::user()->role_id == 2)
				<li><a href="/dashboard#/profile">Бизнес панел</a></li>
				@endif
				<li>
					<div class="dropdown">
						<a href="#" id="user-dropdown" class="dropdown-btn" onclick="dropdown(this)">
							<div class="aligned">
								<div class="avatar">{{ Auth::user()->abbr }}</div>
								<div>
									<i class="fas fa-caret-down"></i>
								</div>
							</div>
						</a>
						<div class="menu-list">
							<a href="/users/settings#/settings" class="item">Акаунт</a>
							<a class="item" href="{{ route('logout') }}"
							onclick="event.preventDefault();
							document.getElementById('logout-form').submit();">
							{{ __('Изход') }}
						</a>

						<form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
							@csrf
						</form>
					</div>
				</div>
			</li>

			<li>
				<a href="/users/settings#/notifications"><i class="far fa-bell"></i></a>
			</li>

				<!-- <li>
					<notifications :user_id="{{ json_encode(auth()->id()) }}"></notifications>
				</li> -->
				
				@endguest
			</ul>
		</div>
	</nav>
</div>