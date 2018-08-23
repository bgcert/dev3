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

		<div class="ui four stackable cards" v-if="venues">
			<venueBox
				v-for="venue in sortedVenues"
				:key="venue.id"
				:item="venue">
			</venueBox>
		</div>

	</div>
</template>

<script>
	import { EventBus } from '../app';
	import VenueBox from './VenueBoxComponent.vue'
	import Like from './LikeComponent.vue'
    export default {
    	components: {
			VenueBox, Like
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