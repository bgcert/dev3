<template>
		<div class="search-container">
			<div class="ui icon input" :class="{ huge: big, fluid: big, loading: loading }">
			  <input type="text" v-model="input" placeholder="Търсене..." @blur="clearSearch">
			  <i class="search icon"></i>
			</div>
			<div class="ui segments search-results" v-if="events.length > 0 || noResults" :class="{ top: big }">
				<div class="ui segment" v-for="event in events" @click="openEvent(event.id)">
					<p>{{ event.theme.title }} - {{ event.start_date_carbon }}</p>
				</div>
				<div class="ui segment" v-if="noResults">
					<p>Няма намерени резултати</p>
				</div>
			</div>
		</div>
</template>

<script>
    export default {
    	props: ['big'],

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

<style>
	.search-container {
		/*width: 30% !important;*/
		position: relative;
	}

	.search-results {
		position: absolute !important;
		color: rgba(0,0,0,.87) !important;
		top: 24px;
		left: 0;
		z-index: 12200;
		width: 200%;
		cursor: pointer;
	}

	.top {
		top: 38px;
		width: 100%;
	}

	.search-container .ui .segment:hover {
		background: #F8F8FA;
	}
</style>