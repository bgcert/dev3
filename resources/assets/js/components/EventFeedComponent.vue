<template>
	<div>
		<request-modal
			auth="1"
			>
		</request-modal>

		<div class="ui three stackable cards">
			<template v-for="event in events">
				<div class="card">
					<div class="extra content">
						<box-hover :name="event.theme.company.name" :logo="event.theme.company.logo" :id="event.theme.company.id"></box-hover>
					</div>
					<div class="image">
						<img :src="event.cover">
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
						</span>
						<i class="comment icon"></i>
						3 comments
					</div>
				</div>
			</template>
		</div>

	</div>
</template>

<script>
	import { EventBus } from '../app';
    export default {
    	props: ['auth'],

    	data: function () {
    		return {
    			events: {}
    		}
    	},

    	methods: {
    		date(date) {
    			return moment(date).format('ddd, D MMM YYYY');
    		},

    		request(id) {
    			EventBus.$emit('testlog', 'some message');
    			console.log('request ' + id);
    		}
    	},

        created() {
            var vm = this;
        	axios.get('/data/eventlist').then(function (response) {
        		vm.events = response.data;
        		console.log('event list');
				console.log(vm.events);
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    }
</script>