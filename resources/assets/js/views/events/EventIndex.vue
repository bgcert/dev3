<template>
	<div class="segment">
		<div class="aligned">
			<h3>Календар</h3>	
			<router-link to="/events/create" class="btn blue">
				Добави събитие
			</router-link>
		</div>
		
		<div v-loading="loading" style="min-height: 200px;">
			<div class="grid grid-1-1-1">
				<template v-for="(event, index) in events">
					<CardDashboard
						:image="'https://d3cwccg7mi8onu.cloudfront.net/fit-in/' + event.cover"
						:date="event.start_date_carbon"
						:title="event.theme.title"
						:edit_link="'/events/edit/' + event.id"
						:confirmMessage="'Сигурни ли сте, че желаете да изтриете това събитие?'"
						@show="handleShow(event.id)"
						@deleteClick="handleDelete(event.id, index)"
						>
					</CardDashboard>
				</template>
			</div>
		</div>
	</div>
</template>

<script>
	import CardDashboard from '../../components/CardDashboardComponent.vue'
    export default {
    	components: {
			CardDashboard
		},
    	data: function () {
    		return {
    			events: [],
    			loading: true
    		}
    	},

    	methods: {
    		handleDelete(id, index) {
    			let vm = this;
    			axios.delete('dashboard/events/' + id).then( function (response) {
    				vm.events.splice(index, 1);
    			});
    		},

    		handleShow(id) {
    			window.open('/event/' + id, '_blank');
    		}
    	},

        mounted() {
            console.log('theme box Component mounted.')
        },

        created() {
        	var vm = this;
            var route = '/dashboard/events';
        	axios.get(route).then(function (response) {
        		console.log(response.data);
        		vm.events = response.data;
        		vm.loading = false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>