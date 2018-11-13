<div class="theme-box-alt">
	<div class="info">
		<div class="title">
			<a href="/theme/{{ $theme->id }}" class="title"> {{ $theme->title }}</a>
		</div>
		<div class="details">
			Времетраене: {{ $theme->duration }} учебни часа
			<div class="category">
				<a href="/browse/{{ $theme->category->slug }}">{{ $theme->category->name }}</a>
			</div>
		</div>
	</div>
	<a
		href="/theme/{{ $theme->id }}"
		class="cover"
		style="background: url(https://d3cwccg7mi8onu.cloudfront.net/266x132/{{ $theme->cover }})">
	</a>
</div>