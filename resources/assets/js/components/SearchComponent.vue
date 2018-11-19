<template>
		<li class="nav-item">
			<div class="position-relative">
				<i class="fas fa-search input-icon"></i>
				<input class="form-control mr-sm-2" type="search" placeholder="Търсене..." v-model="input" @blur="clearSearch" aria-label="Search">
			</div>
			<div class="search-results" v-if="events.length > 0">
				<ul class="list-group">
					<li class="list-group-item list-group-item-action" v-for="event in events" @click="openEvent(event.id)">
						<img :src="'https://d3cwccg7mi8onu.cloudfront.net/60x60/' + event.cover">
						<a href="#">{{ event.theme.title }} - {{ event.start_date_carbon }}</a>
					</li>
				</ul>
			</div>
		</li>
</template>

<script>
    export default {
    	props: ['large'],

    	data: function () {
    		return {
    			loading: false,
    			input: '',
    			events: [],
    			noResults: false
    		}
    	},

    	methods: {
    		searchAfterDebounce: _.debounce(
	            function () {
	                this.search();
	            }, 800 // 800 milliseconds
	        ),

    		search() {
    			let vm = this;
    			let route = '/api/event/search';
    			let search = this.input;
	        	axios.post(route,
	        		{
	        			searchQuery: search,
	        		})
	        		.then(function (response) {
	        			if (response.data.length > 0) {
	        				vm.events = response.data;
	        			} else {
	        				vm.events = [];
	        				vm.noResults = true;
	        			}
		        		vm.loading = false;
					})
					.catch(function (error) {
						console.log(error);
					});
    		},

    		openEvent(id) {
    			window.location.href = "/event/" + id;
    		},

    		clearSearch() {
    			let vm = this;
    			setTimeout(function() {
    				vm.input = '';
    				vm.events = [];
    				vm.noResults = false;
    			}, 200);
    		}
    	},

    	watch: {
		    input: function (val) {
		    	if (val.length > 2) {
		    		this.loading = true;
		    		this.searchAfterDebounce();
		    	}
		    }
		},

        created() {
        	console.log('Search component mounted');
        }
    };
</script>