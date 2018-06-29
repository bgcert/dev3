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
					<template v-for="theme in themes">
						<CardDashboard
							:image="theme.cover"
							:title="theme.title"
							:view_link="'/themes/edit/' + theme.id"
							:edit_link="'/themes/edit/' + theme.id"
							:delete_link="'/themes/delete/' + theme.id">
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
    			themes: '',
    			loading: true
    		}
    	},

    	methods: {

    	},

        mounted() {
            console.log('theme box Component mounted.')
        },

        created() {
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