<div class="container">
	<nav>
		<div class="container aligned">
			<ul class="aligned upercase">
				<li>
					<a href="/" class="logo">
						<img src="/img/logo-s365.png">
					</a>	
				</li>
				<li><a href=/browse">Обучения</a></li>
				<li><a href="/v">Зали</a></li>
				<li><a href="#">Контакти</a></li>
			</ul>

			<ul class="aligned">
				<li><search></search></li>

				@guest
				<li><register-modal></register-modal></li>
				<li><login-modal></login-modal></li>
				@else

				@if(Auth::user()->role_id == 2)
				<li><a href="/dashboard#/profile">Бизнес панел</a></li>
				@endif
				@if(Auth::user()->role_id == 3)
				<li><a href="/admin#/admin-users">Административен панел</a></li>
				@endif
				<li>
					<ul>
						<li>
							<img width="32" src="https://d3cwccg7mi8onu.cloudfront.net/fit-in/80x80/{{ Auth::user()->picture }}"> {{ Auth::user()->firstname }} <i class="dropdown icon"></i>	
						</li>
						<li><a href="/users/settings#/settings" class="item">Акаунт</a></li>
						<li>
							<a class="item" href="{{ route('logout') }}"
		                       onclick="event.preventDefault();
		                                     document.getElementById('logout-form').submit();">
		                        {{ __('Изход') }}
		                    </a>

		                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
		                        @csrf
		                    </form>
						</li>
					</ul>
				</li>
				<li><notifications :user_id="{{ json_encode(auth()->id()) }}"></notifications></li>
				
				@endguest

				<ul>
					<li><a href="/page/help">Помощ</a></li>
					<li><a href="/page/report" class="item">Докладване</a></li>
					<li><a href="/page/contact" class="item">Контакти</a></li>
				</ul>
			</ul>
		</div>
	</nav>
</div>