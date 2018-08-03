<template>
	<div class="search-container">
		<div class="ui fluid icon input" :class="{ loading: loading }">
		  <input type="text" v-model="input" placeholder="Search..." @blur="clearSearch">
		  <i class="search icon"></i>
		</div>
		<div class="ui segments search-results" v-if="events.length > 0">
			<div class="ui segment" v-for="event in events" @click="openEvent(event.id)">
				<p>{{ event.theme.title }} - {{ event.begin_at }}</p>
			</div>
		</div>
	</div>
</template>

<script>
    export default {
    	data: function () {
    		return {
    			loading: false,
    			input: '',
    			events: []
    		}
    	},

    	methods: {
    		search() {
    			let vm = this;
    			let route = '/api/event/search';
    			let search = this.input;
	        	axios.post(route,
	        		{
	        			searchQuery: search,
	        		})
	        		.then(function (response) {
		        		vm.events = response.data;
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
    				console.log(this.events);
    			}, 100);
    		}
    	},

    	watch: {
		    // whenever question changes, this function will run
		    input: function (val) {
		    	if (this.input.length > 2) {
		    		this.loading = true;
		    		this.search();
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
		width: 100% !important;
		position: relative;
	}

	.search-results {
		position: absolute !important;
		top: 30px;
		left: 0;
		z-index: 100;
		width: 100%;
		cursor: pointer;
	}

	.ui .segment:hover {
		background: #F8F8FA;
	}
</style>