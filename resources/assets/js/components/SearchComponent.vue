<template>
		<div class="search" :class="{ large: large }">
			<input type="text" v-model="input" placeholder="Търсене..." @blur="clearSearch">
			<div class="search-results" v-if="events.length > 0 || noResults">
				<ul v-for="event in events" @click="openEvent(event.id)">
					<li><a href="#">{{ event.theme.title }} - {{ event.start_date_carbon }}</a></li>
				</ul>
				<ul v-if="noResults">
					<li>Няма намерени резултати</li>
				</ul>
			</div>
		</div>
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