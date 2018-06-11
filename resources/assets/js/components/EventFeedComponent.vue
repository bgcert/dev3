<template>
	<div>
		<div class="ui huge form">
			<div class="field">
		    	<label>Търси</label>
		    	<input placeholder="Търсене" type="text" v-model="searchQuery">
		    </div>
		</div>
		<br>
		<div class="ui three stackable cards" v-loading.fullscreen.lock="fullscreenLoading">
			<template v-for="event in events">
				<div class="card">
					<div class="extra content">
						<box-hover
							:id="event.theme.company.id"
							:name="event.theme.company.name"
							>
						</box-hover>
					</div>

					<div class="image"
						:style="{ 'background-image': 'url(' + event.cover + ')', 'background-position-y': event.position + 'px' }"
						>
					</div>
					<div class="content">
						<p style="text-transform: uppercase;">
							{{ event.begin_at }}
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
									{{ (event.theme.comment_count != null) ? event.theme.comment_count.count : 0 }}
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
    			events: {},
    			company: [],
    			searchQuery: '',
    			fullscreenLoading: false
    		}
    	},

    	watch: {
	        searchQuery: function (val) {
	        	if (val.length > 2 || val.length == 0) {
	        		this.searchAfterDebounce();
	        	}	            
	        }
	    },

    	methods: {
    		searchAfterDebounce: _.debounce(
	            function () {
	            	this.fullscreenLoading = true;
	                this.search()
	            }, 800 // 800 milliseconds
	        ),

    		search() {
    			let vm = this;
    			let route = '/data/event/search' 
	        	axios.post(route, { searchQuery: this.searchQuery }).then(function (response) {
	        		vm.events = response.data;
	        		vm.fullscreenLoading = false;
				})
				.catch(function (error) {
					console.log(error);
					vm.fullscreenLoading = false;
				});
    		},

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
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>

<style>
	.image {
		height: 178px;
	}
</style>