<template>
	<div>
		<div class="ui segments">
			<div class="ui clearing segment">
				<h3 style="float: left;">Лектори</h3>
				<router-link to="/teachers/create" class="item" style="float: right;">
					<button class="ui tiny basic button">
						<i class="plus icon"></i>
						Добави лектор
					</button>
				</router-link>
			</div>

			<div class="ui segment" v-loading="loading" style="min-height: 200px;">

				<div class="ui three stackable cards">
					<template v-for="(teacher, index) in teachers">
						<CardDashboard
							:image="'http://image-store.seminari365.com/250x150/' + teacher.image"
							:title="teacher.name"
							:edit_link="'/teachers/edit/' + teacher.id"
							:confirmMessage="'Сигурни ли сте, че желаете да изтриете този лектор?'"
							@show="handleShow(theme.id)"
							@deleteClick="handleDelete(teacher.id, index)">
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
    			teachers: {},
    			loading: true
    		}
    	},

    	methods: {
    		handleDelete(id, index) {
    			let vm = this;
    			axios.delete('dashboard/teachers/' + id).then( function (response) {
    				vm.teachers.splice(index, 1);
    			});
    		},
    	},

        mounted() {
            console.log('Teacher index view Component mounted.')
        },

        created() {
        	var vm = this;
            var route = '/dashboard/teachers';
        	axios.get(route).then(function (response) {
        		console.log(response.data);
        		vm.teachers = response.data;
        		vm.loading = false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>