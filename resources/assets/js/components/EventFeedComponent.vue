<template>
	<div>
		<div class="category-header" v-if="category != ''">
			<div class="ui container">
				<div class="ui basic segment">
					<div class="ui breadcrumb inverted-breadcrumb">
						<a href="/" class="section">Начало</a>
						<i class="right angle icon divider"></i>
						<a href="/browse" class="section">Обучения</a>
						<i class="right angle icon divider"></i>
						<div class="active section">{{ category.name }}</div>
					</div>
					<h1>{{ category.name }}</h1>
				</div>
			</div>
		</div>
		<section class="category-segment">
			<div class="ui container">
				<template v-if="category == ''">
					<div class="ui relaxed horizontal list" v-for="category in categories">
						<div class="item">
							<a class="ui large basic inverted button" :href="'/browse/' + category.slug">{{ category.name }}</a>
						</div>
					</div>
				</template>
			</div>
		</section>
		<div class="filter-segment">
			<div class="ui container">

				<div class="ui big form">
					<div class="inline fields" style="margin: 0;">
						<div class="field">
							<label>Филтри:</label>
							<div class="ui selection dropdown">
								<input type="hidden" name="gender">
								<i class="dropdown icon"></i>
								<div class="default text">Подреди по:</div>
								<div class="menu">
									<div class="item" @click="sort('theme.only_like_count', 'desc')">Най-популярни</div>
									<div class="item" @click="sort('begin_at', 'asc')">Най-нови</div>
									<div class="item" @click="sort('price', 'asc')">Цена възх.</div>
									<div class="item" @click="sort('price', 'desc')">Цена низх.</div>
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
										@click="filterByCity(null)">
										Всички
									</div>
									<div
										class="item"
										v-for="city in cities"
										v-model="selectedCity"
										:key="city.id"
										:value="city.id"
										@click="filterByCity(city.id)">
										{{ city.name }}
									</div>
								</div>
							</div>
						</div>
						
					</div>
				</div>
			</div>
		</div>
		<div class="ui container mt-20">
			<div class="ui four stackable cards">
				<eventBox
					v-for="event in events"
					:key="event.id"
					:item="event">
				</eventBox>
			</div>
		</div>
	</div>
</template>

<script>
	import { EventBus } from '../app';
	import EventBox from './EventBoxComponent.vue'
	import Like from './LikeComponent.vue'
    export default {
    	components: {
			EventBox, Like
		},

		props: ['slug'],

    	data: function () {
    		return {
    			auth: window.auth,
    			category: '',
    			categories: {},
    			events: [],
    			cities: [],
    			selectedCity: null,
    			company: [],
    			searchQuery: '',
    			fullscreenLoading: false,
    			// Sorting
    			currentSort: 'id',
  				currentSortDir: 'asc',
  				city_id: null
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

    		sort: function(col, dir) {
    			this.currentSort = col;
    			this.currentSortDir = dir;
			},

			filterByCity(id) {
				this.city_id = id;
    		}
    	},

    	computed: {
    		sortedEvents: function() {
    			let filtered = _.orderBy(this.events, this.currentSort, this.currentSortDir);
    			if (this.city_id) {
    				filtered = _.filter(filtered, { city_id: this.city_id });
    			}
    			return filtered;
    		}
    	},

        created() {
            let vm = this;
            let route = (this.slug) ? '/api/eventlist/' + this.slug : '/api/eventlist';
        	axios.get(route)
	        	.then(function (response) {
	        		vm.events = response.data[0];
	        		vm.cities = response.data[1];
	        		vm.categories = response.data[2];
	        		vm.category = response.data[3];
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

	.category-header {
		color: white;
		margin-bottom: 20px;
		background: linear-gradient(135deg, #011D4A 0%, #448ECB 100%);
		height: 200px;
	}

	.inverted-breadcrumb * {
		color: white !important;
	}

	.category-segment {
		background: linear-gradient(135deg, #011D4A 0%, #448ECB 100%);
		padding: 40px 0;
	}

	.filter-segment {
		background: white;
		padding: 10px 0;
		border: 1px solid #e1e1e1;
	}
</style>