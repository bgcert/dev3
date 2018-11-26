<template>
	<div class="card">
		<div class="card-header d-flex justify-content-between">
			Лектори
			<router-link to="/teachers/create" class="btn btn-primary btn-sm">
				<i class="far fa-plus-square"></i> Добави лектор
			</router-link>
		</div>

		<div class="card-body" v-loading="loading">
			<div class="row">
				<div class="col-4" v-for="(teacher, index) in teachers">
					<CardDashboard
						:image="'https://d3cwccg7mi8onu.cloudfront.net/250x150/' + teacher.image"
						:title="teacher.name"
						:edit_link="'/teachers/edit/' + teacher.id"
						:confirmMessage="'Сигурни ли сте, че желаете да изтриете този лектор?'"
						@show="handleShow(theme.id)"
						@deleteClick="handleDelete(teacher.id, index)">
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