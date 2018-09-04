<template>
	<div>
		<div class="ui segments">
			<div class="ui clearing segment">
				<h3 style="float: left;">Зали</h3>
				<router-link to="/venues/create" class="item" style="float: right;">
					<button class="ui tiny basic button">
						<i class="plus icon"></i>
						Добави зала
					</button>
				</router-link>
			</div>

			<div class="ui segment" v-loading="loading" style="min-height: 200px;">

				<div class="ui three stackable cards">
					<template v-for="(venue, index) in venues">
						<CardDashboard
							:image="'/photos/' + venue.cover"
							:title="venue.name"
							:edit_link="'/venues/edit/' + venue.id"
							:confirmMessage="'Сигурни ли сте, че желаете да изтриете тази зала?'"
							@show="handleShow(venue.id)"
							@deleteClick="handleDelete(venue.id, index)">
						</CardDashboard>
					</template>
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