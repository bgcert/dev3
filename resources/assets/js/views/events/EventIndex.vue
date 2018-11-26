<template>
	<div class="card">
		<div class="card-header d-flex justify-content-between align-items-center">
			Теми
			<router-link to="/events/create" class="btn btn-primary btn-sm">
				<i class="far fa-plus-square"></i> Добави събитие
			</router-link>
		</div>

		<div class="card-body" v-loading="loading">
			<div class="row">
				<div class="col-4" v-for="(event, index) in events">
					<CardDashboard
						:image="'https://d3cwccg7mi8onu.cloudfront.net/fit-in/' + event.cover"
						:date="event.start_date_carbon"
						:title="event.theme.title"
						:edit_link="'/events/edit/' + event.id"
						:confirmMessage="'Сигурни ли сте, че желаете да изтриете това събитие?'"
						@show="handleShow(event.id)"
						@deleteClick="handleDelete(event.id, index)">
					</CardDashboard>
				</div>
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