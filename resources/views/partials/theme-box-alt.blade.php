<div class="card card-theme-alt text-white border-light h-100">
	<div class="row">
		<div class="col-7 h-100 d-flex flex-column justify-content-between">
			<div class="p-3">
				<a href="/theme/{{ $theme->id }}" class="text-light mb-3"> {{ $theme->title }}</a>
				<div>
					Времетраене: {{ $theme->duration }} учебни часа
					<a href="/browse/{{ $theme->category->slug }}" class="btn btn-outline-light">{{ $theme->category->name }}</a>
				</div>
			</div>
		</div>
		<a
			href="/theme/{{ $theme->id }}"
			class="col-5 cover b-block h-100"
			style="height: 100px; background: url(https://d3cwccg7mi8onu.cloudfront.net/270x215/{{ $theme->cover }})">
		</a>
	</div>
</div>