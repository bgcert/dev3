<template>
	<div>
		<div class="card">
			<div class="extra content">
				<box-hover :name="event.theme.company.name" :slug="event.theme.company.slug" :logo="event.theme.company.logo" :id="event.theme.company.id"></box-hover>
			</div>
			<div class="image">
				<img :src="theme.cover">
			</div>
			<div class="content">
				<p style="text-transform: uppercase;">
					{{ date(event.begin_at) }}
				</p>
				<a :href="'/event/' + event.id" class="header">{{ event.theme.title }}</a>
			</div>
			<div class="extra content">
				<span class="right floated">
					<like
						:auth="auth"
						:likes="(event.theme.like_count != null) ? event.theme.like_count.count : ''"
						:liked="event.theme.is_liked.length"
						:item_id="event.theme.id"
						:route="'/users/like/theme'"
						>
					</like>
					<span>
						<a :href="'/event/' + event.id + '/#comments'">
							<i class="comment outline icon"></i>
							{{ event.theme.comment_count.count }}
						</a>
					</span>
				</span>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
    	props: ['auth', 'item'],
    	data: function () {
    		return {
    			theme: this.item,
    		}
    	},

    	methods: {

    	},

        mounted() {
            console.log('theme box Component mounted.')
        }
    }
</script>