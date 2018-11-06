<template>
	<div>
		<form class="form">
			<div class="field">
				<label>Стара парола</label>
				<input type="password" v-model="form.oldPassword">
			</div>
			<div class="field">
				<label>Нова парола</label>
				<input type="password" v-model="form.newPassword">
			</div>
			<div class="field">
				<label>Нова парола (отново)</label>
				<input type="password" v-model="form.confirmNewPassword">
			</div>
			<div class="field">
				<button class="btn blue" @click.prevent="changePassword"> Промени</button>
			</div>
			
		</form>

	</div>
</template>

<script>
	import { EventBus } from '../../app';
    export default {
    	data: function () {
    		return {
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
    		changePassword() {
    			var vm = this;
    			var route = '/users/change/password';
    			axios.post(route,
    				{
    					old_password: vm.form.oldPassword,
    					new_password: vm.form.newPassword,
    					new_password_confirmation: vm.form.confirmNewPassword
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
    		}
    	},

        mounted() {
            console.log('ChangePassword view mounted.')
        },

        created() {

        }
    }
</script>