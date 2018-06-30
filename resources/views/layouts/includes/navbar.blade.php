<div id="nav-header">
	<div class="ui container">
		<div class="ui secondary menu">
			<a href="/" class="active item"> Seminari 365</a>
			<a href="/e" class="item"> Обучения</a>
			<a href="/v" class="item"> Зали</a>
			<category-menu></category-menu>

			<div class="ui mini form">
				<div class="ui action left icon input">
					<i class="search icon"></i>
					<input type="text" placeholder="Search...">
					<div class="ui orange button">Search</div>
				</div>
			</div>
			<div class="right menu">
				@guest
				<register></register>			
				<login></login>
				<!-- <div class="item">
					<a class="ui basic secondary button" href="{{ route('login') }}">{{ __('Login') }}</a>	
					<a class="ui basic primary button" href="{{ route('register') }}">{{ __('Register') }}</a>                
				</div> -->
				@else

				<div class="ui dropdown item">
					{{ Auth::user()->name }} <i class="dropdown icon"></i>
					<div class="menu">
						<a href="/users/settings#/account" class="item">Настройки</a>
						@if(Auth::user()->role_id == 2)
						<a href="/dashboard#/home" class="item">Контролен панел</a>
						@endif
						<a class="item" href="{{ route('logout') }}"
	                       onclick="event.preventDefault();
	                                     document.getElementById('logout-form').submit();">
	                        {{ __('Logout') }}
	                    </a>

	                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
	                        @csrf
	                    </form>
					</div>
				</div>
				<a href="/messages#/t" class="item">
					<i class="paper plane outline icon"></i>
				</a>
				<notifications :user_id="{{ json_encode(auth()->id()) }}"></notifications>
				<span class="item">
				  <i class="question outline circle icon"></i>
				</span>
				@endguest
			</div>
		</div>
	</div>

</div>
