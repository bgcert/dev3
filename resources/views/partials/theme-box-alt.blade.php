<div class="card card-theme-alt text-white border-light">
	<div class="d-flex">
		<div class="title">
			<div class="card-body h-100">
				<div class="d-flex align-items-start flex-column h-100">
					<a href="/theme/{{ $theme->id }}" class="mb-auto text-light"> {{ $theme->title }}</a>
					<div>
						Времетраене: {{ $theme->duration }} учебни часа
						<a href="/browse/{{ $theme->category->slug }}" class="btn btn-outline-light mt-2">{{ $theme->category->name }}</a>
					</div>
				</div>
			</div>
		</div>

		<div class="cover">
			<a
				href="/theme/{{ $theme->id }}"
				class="b-block"
				style="height: 100px; background: url(https://d3cwccg7mi8onu.cloudfront.net/270x215/{{ $theme->cover }})">
			</a>
		</div>
	</div>
</div>