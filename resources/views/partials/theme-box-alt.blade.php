<div class="theme-box-alt">
	<div class="content">
		<a href="/theme/{{ $theme->id }}" class="title">
			{{ $theme->title }}
		</a>
		<div class="info">
			<div>
				Времетраене: {{ $theme->duration }} учебни часа
			</div>
			<div><a href="#"> {{ $theme->category->name }}</a></div>
		</div>
	</div>
	<a href="/theme/{{ $theme->id }}" class="cover" style="background: url(https://d3cwccg7mi8onu.cloudfront.net/266x132/{{ $theme->cover }})"></a>
</div>