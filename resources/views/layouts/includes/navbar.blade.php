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
							Меню
							<i class="fas fa-caret-down"></i>
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
									{{ Auth::user()->firstname }}
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

				<!-- <li>
					<notifications :user_id="{{ json_encode(auth()->id()) }}"></notifications>
				</li> -->
				
				@endguest
			</ul>
		</div>
	</nav>
</div>