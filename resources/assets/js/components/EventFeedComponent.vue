<template>
	<div>
		<div class="ui segment">
			<div class="ui form">
				<div class="fields">
					<div class="field">
						<div class="ui selection dropdown">
							<input type="hidden" name="gender">
							<i class="dropdown icon"></i>
							<div class="default text">Подреди по:</div>
							<div class="menu">
								<div class="item">Най-популярни</div>
								<div class="item" @click="sort('begin_at')">Най-нови</div>
								<div class="item" @click="sort('price')">Цена възх.</div>
								<div class="item">Цена низх.</div>
							</div>
						</div>
					</div>
					<div class="field">
						<div class="ui selection dropdown">
							<input type="hidden" name="gender">
							<i class="dropdown icon"></i>
							<div class="default text">Град</div>
							<div class="menu">
								<div
									class="item"
									v-for="city in cities"
									v-model="selectedCity"
									:key="city.id"
									:value="city.id">
										{{ city.name + ' (' + city.events_count + ')' }}
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
		<div class="ui three stackable cards" v-loading.fullscreen.lock="fullscreenLoading">
			<template v-for="event in sortedEvents">
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
						<div class="flex">
							<div>
								<el-tooltip class="item" effect="dark" content="Прегледан" placement="top">
									<i class="eye icon"></i>
								</el-tooltip>
									54
							</div>
							<el-tooltip class="item" effect="dark" content="Харесай" placement="top">
								<Like
									:likes="(event.theme.like_count != null) ? event.theme.like_count.count : ''"
									:liked="event.theme.is_liked != null"
									:item_id="event.theme.id"
									:route="'/users/like/theme'">
								</Like>
							</el-tooltip>
							
							<a :href="'/event/' + event.id + '/#comments'">
								<el-tooltip class="item" effect="dark" content="Коментари" placement="top">
									<i class="comment outline icon"></i>
								</el-tooltip>
								{{ (event.theme.comment_count != null) ? event.theme.comment_count.count : 0 }}
							</a>
						</div>
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

		props: ['slug'],

    	data: function () {
    		return {
    			auth: window.auth,
    			boolean: true,
    			events: [],
    			cities: [],
    			selectedCity: null,
    			company: [],
    			searchQuery: '',
    			fullscreenLoading: false,
    			// Sorting
    			currentSort: 'name',
  				currentSortDir: 'asc'
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

    		sort: function(sort) {
    			console.log('sort');
			    //if s == current sort, reverse
			    if(sort === this.currentSort) {
			    	this.currentSortDir = this.currentSortDir==='asc'?'desc':'asc';
			    }
			    this.currentSort = sort;
			}
    	},

    	computed: {
    		sortedEvents:function() {
    			return this.events.sort((a,b) => {
    				let modifier = 1;
    				if(this.currentSortDir === 'desc') modifier = -1;
    				if(a[this.currentSort] < b[this.currentSort]) return -1 * modifier;
    				if(a[this.currentSort] > b[this.currentSort]) return 1 * modifier;
    				return 0;
    			});
    		}
    	},

        created() {
            let vm = this;
            let route = (this.slug) ? '/api/eventlist/' + this.slug : '/api/eventlist';
        	axios.get(route)
	        	.then(function (response) {
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

	.flex {
		display: flex;
		justify-content: space-around;
	}
</style>