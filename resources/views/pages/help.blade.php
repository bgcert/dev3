@extends('layouts.app')

@push('header-scripts')
<!-- Load Facebook SDK for JavaScript -->
<div id="fb-root"></div>
<script>
	(function(d, s, id) {
		var js, fjs = d.getElementsByTagName(s)[0];
		if (d.getElementById(id)) return;
		js = d.createElement(s); js.id = id;
		js.src = 'https://connect.facebook.net/en_US/sdk/xfbml.customerchat.js#xfbml=1&version=v2.12&autoLogAppEvents=1';
		fjs.parentNode.insertBefore(js, fjs);
	}(document, 'script', 'facebook-jssdk'));
</script>

<!-- Your customer chat code -->
<div class="fb-customerchat"
	attribution=setup_tool
	page_id="149145054051"
	theme_color="#ff7e29"
	logged_in_greeting="Здравейте! Как можем да Ви помогнем?"
	logged_out_greeting="Здравейте! Как можем да Ви помогнем?">
</div>
@endpush

@section('content')

<div class="ui container">
	<div class="ui segment mt-20">
		<div class="ui styled accordion">
			<div class="title">
				<i class="dropdown icon"></i>
				Активиране на "Бизнес акаунт"
			</div>
			<div class="content">
				<div class="transition hidden">
					<div class="ui ordered list">
						<div class="item">Заредете меню настройки (Потребителскко меню -> Акаунт -> Настройки)</div>
						<div class="item">Кликнете върху отметката "Бизнес акаунт"</div>
						<div class="item">Въведете името на организацията и адрес на профил</div>
						<div class="item">Изберете една или две от опциите за публикуване</div>
						<div class="item">Запишете промените</div>
					</div>
				</div>
			</div>
			<div class="title">
				<i class="dropdown icon"></i>
				Как да публикувам обучение?
			</div>
			<div class="content">
				<div class="transition visible">
					<div class="ui ordered list">
						<div class="item">Активирайте опцията "Бизнес акаунт"</div>
						<div class="item">Отворете бизнес панела</div>
						<div class="item">Добавете тема (Бизнес панел -> Теми -> Добави тема)</div>
						<div class="item">Добавете събитие (Бизнес панел -> Календар -> Добави събитие)</div>
					</div>
				</div>
			</div>
			<div class="title">
				<i class="dropdown icon"></i>
				Как да публикувам зала/конферентен център
			</div>
			<div class="content">
				<div class="transition visible">
					<div class="ui ordered list">
						<div class="item">Активирайте опцията "Бизнес акаунт"</div>
						<div class="item">Отворете бизнес панела</div>
						<div class="item">Добавете зала (Бизнес панел -> Зали -> Добави зала)</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection

@push('footer-scripts')
	<script>
		$('.accordion')
		  .accordion({
		    selector: {
		      trigger: '.title'
		    }
		  })
		;
	</script>
@endpush