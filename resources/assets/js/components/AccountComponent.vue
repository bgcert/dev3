<template>
	<div class="my-4">

		<div class="card">
			<div class="card-header">
				<ul class="nav nav-tabs card-header-tabs">
					<li class="nav-item">
						<router-link
							to="/notifications"
							class="nav-link"
							:class="{ active: $route.path == '/notifications' }">
							Известия
						</router-link>
					</li>

					<li class="nav-item">
						<router-link
							to="/settings"
							class="nav-link"
							:class="{ active: $route.path == '/settings' }">
							Настройки
						</router-link>
					</li>

					<li class="nav-item">
						<router-link
							to="/change-pass"
							class="nav-link"
							:class="{ active: $route.path == '/change-pass' }">
							Промяна на парола
						</router-link>
					</li>

					<li class="nav-item">
						<router-link
							to="/change-email"
							class="nav-link"
							:class="{ active: $route.path == '/change-email' }">
							Промяна на email
						</router-link>
					</li>

					<li class="nav-item" style="display: none;">
						<router-link
							to="/deactivate"
							class="nav-link"
							:class="{ active: $route.path == '/deactivate' }">
							Изтриване на акаунт
						</router-link>
					</li>
				</ul>
			</div>
			<div class="card-body">
				<keep-alive>
					<router-view></router-view>
				</keep-alive>
			</div>
		</div>
		
	</div>
</template>

<script>
	import { EventBus } from '../app';
    export default {
		props: ['id'],

    	data: function () {
    		return {
    			activeTab: this.$route.path,
    			form: {
    				publisher: false,
	    			user: {

	    			},
	    			oldPassword: '',
					newPassword: '',
					confirmNewPassword: '',
					email: '',
					password: ''
    			},
    			company: {
    				name: '',
    				slug: '',
    				event_publish: false,
    				venue_publish: false
				}
    		}
    	},

    	methods: {

    		setName() {
    			var vm = this;
    			var route = '/users/set/user/name';
    			axios.post(route, { id: vm.id, name: vm.form.user.name })
				.then(function (response) {
					console.log(response);
					vm.$message('Името е променено.');
				})
				.catch(function (error) {
					console.log(error);
				});
    		},

    		setPublisher() {
    			var vm = this;
    			var route = '/users/set/publisher/data';
    			axios.post(route,
    				{
    					id: vm.id,
    					publisher: vm.form.publisher,
    					name: vm.form.user.company.name,
    					slug: vm.form.user.company.slug,
    					event_publish: vm.form.user.company.event_publish,
    					venue_publish: vm.form.user.company.venue_publish
    				})
				.then(function (response) {
					console.log(response);
					vm.$message('Данните са променени.');
				})
				.catch(function (error) {
					console.log(error);
				});
    			console.log(this.company);
    		},

    		changePassword() {
    			var vm = this;
    			var route = '/users/change/password';
    			axios.post(route,
    				{
    					old_password: vm.form.oldPassword,
    					new_password: vm.form.newPassword,
    					new_password_confirmation: vm.form.newPasswordConfirmation
    				})
				.then(function (response) {
					if (response.data.error) {
						vm.$message({
				        	message: response.data.error,
				        	type: 'warning'
				        });
					} else {
						vm.$message({
				        	message: response.data.success,
				        	type: 'success'
				        });
					}
					vm.form.oldPassword = '';
		        	vm.form.newPassword = '';
		        	vm.form.newPasswordConfirmation = '';
				})
				.catch(function (error) {
					console.log(error);
				});
    		},
    	},

        mounted() {
            console.log('Settings mounted.')
        },

        created() {
        	console.log(this.$route.path);
            var vm = this;
            var route = '/users/load/user/';
        	axios.get(route).then(function (response) {
        		console.log(response.data);
        		vm.form.user = response.data;
        		if (response.data.company) {
        			vm.form.user.company = response.data.company;
        		} else {
        			vm.form.user.company = vm.company;
        		}
        		vm.form.publisher = (response.data.role_id == 2) ? true : false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>