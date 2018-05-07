<template>
	<div>
		<request-modal
			auth="1"
			>
		</request-modal>

		<div class="ui three stackable cards">
			<template v-for="venue in venues">
				<div class="card">
					<div class="extra content">
						<box-hover
							:id="venue.company.id"
							:name="venue.company.name"
							>
						</box-hover>
					</div>
					<div class="image">
						<img :src="venue.cover">
					</div>
					<div class="content">
						<a :href="'/venue/' + venue.id" class="header">{{ venue.name }}</a>
					</div>
					<div class="extra content">
						<span class="right floated">
							<like
								:auth="auth"
								:likes="(venue.like_count != null) ? venue.like_count.count : ''"
								:liked="venue.is_liked.length"
								:item_id="venue.id"
								:route="'/users/like/venue'"
								>
							</like>
							<span>
								<a :href="'/venue/' + venue.id + '/#comments'">
									<i class="comment outline icon"></i>
									{{ venue.comment_count.count }}
								</a>
							</span>
						</span>
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
    			venues: {},
    		}
    	},

    	methods: {

    		request(id) {
    			EventBus.$emit('testlog', 'some message');
    			console.log('request ' + id);
    		}

    	},

        created() {
            var vm = this;
        	axios.get('/data/venuelist').then(function (response) {
        		vm.venues = response.data;
        		console.log('event list');
				console.log(vm.events);
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    }
</script>