<template>
	<div class="card">
		<div class="card-header d-flex justify-content-between align-items-center">
			Теми
			<router-link to="/themes/create" class="btn btn-primary btn-sm">
				<i class="far fa-plus-square"></i> Добави тема
			</router-link>
		</div>
		
		<div class="card-body" v-loading="loading">
			<div class="row">
				<div class="col-4" v-for="(theme, index) in themes">
					<CardDashboard
						:image="'https://d3cwccg7mi8onu.cloudfront.net/250x150/' + theme.cover"
						:title="theme.title"
						:edit_link="'/themes/edit/' + theme.id"
						:confirmMessage="'Сигурни ли сте, че желаете да изтриете тази тема?'"
						@show="handleShow(theme.id)"
						@deleteClick="handleDelete(theme.id, index)">
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
    			themes: {},
    			loading: true
    		}
    	},

    	methods: {
    		handleDelete(id, index) {
    			let vm = this;
    			axios.delete('dashboard/themes/' + id).then( function (response) {
    				vm.themes.splice(index, 1);
    			});
    		},

    		handleShow(id) {
    			window.open('/theme/' + id, '_blank');
    		}
    	},

        mounted() {
            console.log('theme box Component mounted.');
        },

        created() {
        	this.$on('deleteItem', this.handleDelete);
        	var vm = this;
            var route = '/dashboard/themes';
        	axios.get(route).then(function (response) {
        		console.log(response.data);
        		vm.themes = response.data;
        		vm.loading = false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>