<template>
	<div>
		<div class="ui segments">
			<div class="ui clearing segment">
				<h3 style="float: left;">Теми</h3>
				<router-link to="/themes/create" class="item" style="float: right;">
					<button class="ui tiny basic button">
						<i class="plus icon"></i>
						Добави тема
					</button>
				</router-link>
			</div>

			<div class="ui segment" v-loading="loading" style="min-height: 200px;">

				<div class="ui three stackable cards">
					<template v-for="(theme, index) in themes">
						<CardDashboard
							:image="'image-store.seminari365.com/250x150/' + theme.cover"
							:title="theme.title"
							:edit_link="'/themes/edit/' + theme.id"
							:confirmMessage="'Сигурни ли сте, че желаете да изтриете тази тема?'"
							@show="handleShow(theme.id)"
							@deleteClick="handleDelete(theme.id, index)">
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