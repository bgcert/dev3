<template>
	<div>
		<div v-for="event in events">
			<event-box
				:auth="auth"
				:item="event"
				>
			</event-box>
		</div>	
	</div>
</template>

<script>
    export default {
    	props: ['auth'],

    	data: function () {
    		return {
    			events: {}
    		}
    	},

        created() {
            var vm = this;
        	axios.get('/data/eventlist').then(function (response) {
        		vm.events = response.data;
        		console.log('event list');
				console.log(vm.events);
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    }
</script>