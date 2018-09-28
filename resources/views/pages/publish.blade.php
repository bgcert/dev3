@extends('layouts.app')

@section('content')

<div class="ui container">
	<div class="ui padded segment mt-20">
		<h2>Информация за платформата</h2>
		<p>Семинари 365 е платформа насочена към тъсещите и предлагащите обучения, както и към фирмите предлагащи места за провеждане на събития и настаняване, като:</p>
		<div class="ui bulleted list">
			<div class="item">хотели</div>
			<div class="item">конферентни центрове</div>
			<div class="item">учебни зали</div>
			<div class="item">зали за събития</div>
			<!-- <div class="item">кетеринг</div>
			<div class="item">видео заснемане</div> -->
		</div>
		<h2 class="ui header">Как да публикувате в Семинари365?</h2>
		<p>Платформата предлага безплатно публикуване на обучения и зали (места за провеждане на обучения)</p>
		<h3 class="ui header">Как да публикувате обучение?</h3>
		<div class="ui ordered list">
			<div class="item">Логнете се в системата</div>
			<div class="item">Активирайте <a href="/users/settings#/settings" target="_blank">бизнес акаунт</a></div>
			<div class="item">Активирайте опцията "Публикуване на събития"</div>
			<div class="item">Кликнете върху бутон "Бизнес панел"</div>
			<div class="item">Добавете тема (Бизнес панел->Теми->Добави тема)</div>
			<div class="item">Добавете събитие (Бизнес панел->Календар->Добави събитие)</div>
		</div>
		<h3 class="ui header">Как да публикувате зала?</h3>
		<div class="ui ordered list">
			<div class="item">Логнете се в системата</div>
			<div class="item">Активирайте <a href="/users/settings#/settings" target="_blank">бизнес акаунт</a></div>
			<div class="item">Активирайте опцията "Публикуване на зали"</div>
			<div class="item">Кликнете върху бутон "Бизнес панел"</div>
			<div class="item">Добавете зала (Бизнес панел->Зали->Добави зала)</div>
		</div>
	</div>
</div>
@endsection