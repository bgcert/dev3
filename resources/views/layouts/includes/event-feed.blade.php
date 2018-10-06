<div class="ui four stackable cards">
	@foreach($events as $event)
		<div class="ui card">
			<a href="/event/{{ $event->id }}" class="image image_container" style="background: url(https://d3cwccg7mi8onu.cloudfront.net/266x132/{{ $event->cover }})">
				<a class="owner" href="/c/{{ $event->theme->company->slug }}">
					<img src="https://d3cwccg7mi8onu.cloudfront.net/50x50/{{ $event->theme->company->logo }}">
				</a>
				<span class="price">{{ $event->price }} лв.</span>
			</a>
			<div class="content content-box">
				<a href="/event/{{ $event->id }}" class="header">{{ $event->theme->title }}</a>
				<p style="text-transform: uppercase;"> {{ $event->start_date_carbon }}</p>
			</div>
			<div class="extra content">
				<div class="box_footer">
					<rateing :rateing="0"></rateing>
					<!-- <div>
						<el-tooltip class="item" effect="dark" content="Прегледан" placement="top">
							<i class="eye icon"></i>
						</el-tooltip>
							--
					</div> -->
		<!-- 				<el-tooltip class="item" effect="dark" content="Харесай" placement="top">
						<Like
							:likes="item.theme.only_like_count"
							:liked="item.theme.is_liked != null"
							:item_id="item.theme.id"
							:route="'/users/like/theme'">
						</Like>
					</el-tooltip> -->
					<div>
						<i class="eye icon"></i> {{ $event->visits }}
					</div>

					<a href="/event/{{ $event->id }}/#comments">
						<el-tooltip class="item" effect="dark" content="Коментари" placement="top">
							<i class="comment outline icon"></i>
						</el-tooltip>
						{{ $event->theme->only_comment_count }}
					</a>
				</div>
			</div>
		</div>
	@endforeach
</div>