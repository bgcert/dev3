<template>
	<div>
		<v-app>
			<v-layout row justify-center>

				<v-dialog v-model="dialog" max-width="390">
					<v-card>
						<v-card-title class="headline">Сигурни ли сте, че желаете ли да изтриете темата</v-card-title>

						<v-card-actions>
								
							<v-spacer></v-spacer>

							<v-btn color="green darken-1" flat="flat" @click="dialog = false"> Не</v-btn>
							<v-btn color="green darken-1" flat="flat" @click="dialog = false" > Да</v-btn>
						</v-card-actions>
					</v-card>
				</v-dialog>
			</v-layout>

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
							:edit_link="'/themes/edit/' + theme.id"
							v-on:show="handleShow(theme.id)"
							v-on:deleteItem="handleDelete(theme.id)"
							>
						</CardDashboard>
					</template>
				</div>

			</div>
		</div>
		</v-app>
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
    			dialog: false,
    			dialogVisible: false,
    			themes: '',
    			loading: true
    		}
    	},

    	methods: {
    		handleDelete(id) {
    			console.log('delete');
    		},

    		handleShow(id) {
    			window.open('/theme/' + id, '_blank');
    		}
    	},

        mounted() {
            console.log('theme box Component mounted.')
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