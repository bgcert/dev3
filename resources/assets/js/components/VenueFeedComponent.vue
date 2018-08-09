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
								<div class="item" @click="sort('only_like_count', 'desc')">Най-популярни</div>
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
									:key="city.id"
									:value="city.id"
									@click="filterByCity(city.id)">
									{{ city.name }}
								</div>
							</div>
						</div>
					</div>				
				</div>
				<div class="field">
					<label>Капацитет</label>
					<el-slider
						v-model="range"
						range
						show-stops
						:max="100"
						:min="5">
					</el-slider>
				</div>
			</div>
		</div>

		<div class="ui three stackable cards" v-if="venues">
			<template v-for="venue in sortedVenues">
				<div class="card" :key="venue.id">
					<div class="extra content">
						<box-hover
							:id="venue.company.id"
							:name="venue.company.name">
						</box-hover>
					</div>
					<div class="image" :style="`background: url(${venue.cover})`">
						<div style="display:inline-block; padding: 5px; margin: 3px; background-color: white;">{{ venue.price }} лв.</div>
					</div>
					<div class="content">
						<a :href="'/venue/' + venue.id" class="header">{{ venue.name }}</a>
					</div>
					<div class="extra content">
						<div class="flex">
							<div>
								<el-tooltip class="item" effect="dark" content="Прегледан" placement="top">
									<i class="eye icon"></i>
								</el-tooltip>
									54
							</div>
							<div>
								<like
									:likes="venue.only_like_count"
									:liked="venue.is_liked != null"
									:item_id="venue.id"
									:route="'/users/like/venue'">
								</like>
							</div>	
							<div>
								<a :href="'/venue/' + venue.id + '/#comments'">
									<i class="comment outline icon"></i>
									{{ venue.only_comment_count }}
								</a>
							</div>
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

    	data: function () {
    		return {
    			auth: window.auth,
    			venues: [],
    			cities: [],
    			// Sorting
    			currentSort: 'id',
  				currentSortDir: 'asc',
  				city_id: null,
  				range: [0, 100]
    		}
    	},

    	methods: {

    		request(id) {
    			EventBus.$emit('testlog', 'some message');
    			console.log('request ' + id);
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
    		sortedVenues: function() {
    			let filtered = _.orderBy(this.venues, this.currentSort, this.currentSortDir);
    			let min = this.range[0];
    			let max = (this.range[1] < 100) ? this.range[1] : 2000;
    			filtered = _.filter(filtered, o => o.capacity > min && o.capacity < max);
    			if (this.city_id) {
    				filtered = _.filter(filtered, { city_id: this.city_id });
    			}
    			return filtered;
    		}
    	},

        created() {
            var vm = this;
        	axios.get('/api/venuelist').then(function (response) {
        		vm.venues = response.data[0];
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