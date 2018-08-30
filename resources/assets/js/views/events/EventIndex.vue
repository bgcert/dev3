<template>
	<div>
		<div class="ui segments">
			<div class="ui clearing segment">
				<h3 style="float: left;">Календар</h3>
				<router-link to="/events/create" class="item" style="float: right;">
					<button class="ui tiny basic button">
						<i class="plus icon"></i>
						Добави събитие
					</button>
				</router-link>
			</div>

			<div class="ui segment" v-loading="loading" style="min-height: 200px;">

				<div class="ui three stackable cards">
					<template v-for="(event, index) in events">
						<CardDashboard
							:image="'/photos/ev/m/' + event.cover"
							:date="event.begin_at"
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