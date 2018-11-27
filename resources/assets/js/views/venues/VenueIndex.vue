<template>
	<div class="card">
		<div class="card-header d-flex justify-content-between align-items-center">
			Зали
			<router-link to="/venues/create" class="btn btn-primary btn-sm">
				<i class="far fa-plus-square"></i> Добави зала
			</router-link>
		</div>

		<div class="card-body" v-loading="loading">
			<div class="row">
				<div class="col-4" v-for="(venue, index) in venues">
					<CardDashboard
						:image="'https://d3cwccg7mi8onu.cloudfront.net/fit-in/' + venue.cover"
						:title="venue.name"
						:edit_link="'/venues/edit/' + venue.id"
						:confirmMessage="'Сигурни ли сте, че желаете да изтриете тази зала?'"
						@show="handleShow(venue.id)"
						@deleteClick="handleDelete(venue.id, index)">
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
    			venues: {},
    			loading: true
    		}
    	},

    	methods: {
    		handleDelete(id, index) {
    			let vm = this;
    			axios.delete('dashboard/venues/' + id).then( function (response) {
    				vm.venues.splice(index, 1);
    			});
    		},

    		handleShow(id) {
    			window.open('/venue/' + id, '_blank');
    		}
    	},

        mounted() {
            console.log('venue index Component mounted.');
        },

        created() {
        	this.$on('deleteItem', this.handleDelete);
        	var vm = this;
            var route = '/dashboard/venues';
        	axios.get(route).then(function (response) {
        		vm.venues = response.data;
        		vm.loading = false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>