<template>
	<div>
		<div class="ui vertical segment">

			<div class="ui center aligned grid container">
				<div class="column">
					<h3 class="ui header">
						Semantic is growing fast. Want to see just how much? Sign up and we'll let you know
					</h3>

					<div class="ui big form">
						<div class="field">
							<span class="ui icon input" style="width: 450px;">
								<i class="search icon"></i>
					    		<input placeholder="Търсене" type="text" v-model="searchQuery">
							</span>
					    	<span>
					    		<el-select
					    			v-model="selectedCity"
					    			filterable
					    			clearable
					    			no-match-text="Няма открити"
					    			placeholder="Всички градове">
									<el-option
										v-for="city in cities"
										:key="city.id"
										:label="city.name + ' (' + city.events_count + ')'"
										:value="city.id">
									</el-option>
								</el-select>
					    	</span>
					    </div>
					</div>
				</div>
			</div>
		</div>
		<br>
		<div class="ui three stackable cards" v-loading.fullscreen.lock="fullscreenLoading">
			<template v-for="event in events">
				<div class="card">
					<div class="extra content">
						<BoxHover
							:id="event.theme.company.id"
							:name="event.theme.company.name">
						</BoxHover>
					</div>

					<div class="image"
						:style="`background: url(${event.cover})`"
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
							<Like
								:auth="auth"
								:likes="(event.theme.like_count != null) ? event.theme.like_count.count : ''"
								:liked="event.theme.is_liked.length"
								:item_id="event.theme.id"
								:route="'/users/like/theme'">
							</Like>
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
	import Like from './LikeComponent.vue'
	import BoxHover from './BoxHoverComponent.vue'
    export default {
    	components: {
			Like, BoxHover
		},

    	data: function () {
    		return {
    			auth: window.auth,
    			boolean: true,
    			events: {},
    			cities: [],
    			selectedCity: null,
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
	        },

	        selectedCity: function() {
	        	this.searchAfterDebounce();
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
    			let route = '/api/event/search';
    			let city = this.selectedCity ? this.selectedCity : null;
    			let search = this.searchQuery ? this.searchQuery : null;
	        	axios.post(route,
	        		{
	        			searchQuery: search,
	        			city_id: city
	        		})
	        		.then(function (response) {
		        		vm.events = response.data;
		        		vm.fullscreenLoading = false;
					})
					.catch(function (error) {
						console.log(error);
						vm.fullscreenLoading = false;
					});
    		},
    	},

        created() {
            var vm = this;
        	axios.get('/api/eventlist').then(function (response) {
        		vm.events = response.data[0];
        		vm.cities = response.data[1];
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
		background-size: cover !important;
		background-position: center center !important;
	}
</style>