<template>
	<div class="form" v-loading="loading">
		<div class="text-center">
			<h2>Добре дошли в Seminari365</h2>
			<h5>Регистрирайте се, за да продължите.</h5>
		</div>
		<form>
			<div class="form-group">
				<label>Име</label>
				<input
					type="text"
					name="firstname"
					class="form-control"
					:class="{ 'is-invalid': errors.firstname }"
					v-model="form.firstname"
					placeholder="Въведете име"
					autofocus
					required>

				<div class="invalid-feedback" v-if="errors.firstname">
					{{ errors.firstname[0] }}
				</div>
			</div>

			<div class="form-group">
				<label>Фамилия</label>
				<input
					type="text"
					name="lastname"
					class="form-control"
					:class="{ 'is-invalid': errors.lastname }"
					v-model="form.lastname"
					placeholder="Въведете фамилия"
					required>

				<div class="invalid-feedback" v-if="errors.lastname">
					{{ errors.lastname[0] }}
				</div>
			</div>

			<div class="form-group">
				<label>E-mail</label>
				<input
					type="email"
					name="email"
					class="form-control"
					:class="{ 'is-invalid': errors.email }"
					v-model="form.email"
					placeholder="Въведете E-mail"
					required>

				<div class="invalid-feedback" v-if="errors.email">
					{{ errors.email[0] }}
				</div>
			</div>

			<div class="form-group">
				<label>Парола</label>
				<input
					type="password"
					name="password"
					class="form-control"
					:class="{ 'is-invalid': errors.password }"
					v-model="form.password"
					placeholder="Въведете парола"
					required>

				<div class="invalid-feedback" v-if="errors.password">
					{{ errors.password[0] }}
				</div>
			</div>

			<div class="form-group">
				<label>Повторете парола</label>
				<input
					type="password"
					name="password_confirmation"
					class="form-control"
					:class="{ 'is-invalid': errors.password_confirmation }"
					v-model="form.passwordConfirm"
					placeholder="Повторете парола"
					required>

				<div class="invalid-feedback" v-if="errors.password_confirmation">
					{{ errors.password_confirmation[0] }}
				</div>
			</div>

			<div class="form-group">
				<captcha></captcha>
			</div>

			<div class="form-group">
				<button class="btn btn-primary btn-block" @click.prevent="onSubmit">Регистрирай се</button>
				<small class="form-text text-muted">
					С натискане на бутон "Регистрирай се", Вие се съгласявате с <a href="terms" target="_blank">условията за ползване</a>.
				</small>
			</div>
		</form>
	</div>
</template>

<script>
	import { EventBus } from '../../app';
    export default {

    	data: function () {
    		return {
    			loading: false,
    			terms: false,
    			form: {
    				firstname: '',
    				lastname: '',
    				email: '',
    				password: '',
    				passwordConfirm: '',
    			},
    			errors: []
    		}
    	},

        mounted() {
            console.log('Register Component mounted.')
        },

        methods: {
        	checkCaptcha() {
    			let promise = new Promise((resolve, reject) => EventBus.$emit('captcha', resolve, reject));
    			return promise;
    		},
        	async onSubmit() {
        		let vm = this;

        		try {
					await this.checkCaptcha();
					vm.loading = false;
				} catch(e) {
					vm.loading = false;
				    return;
				}

				vm.loading = true;

        		axios.post('/register', {
        			firstname: vm.form.firstname,
        			lastname: vm.form.lastname,
        			email: vm.form.email,
        			password: vm.form.password,
        			password_confirmation: vm.form.passwordConfirm
        		})
        		.then(function (response) {
        			window.location.href = '/page/confirm';
        		})
        		.catch(function (error) {
        			vm.errors = error.response.data.errors;
        			vm.loading = false;
        		});
        	}
        },

        mounted() {
        	console.log('Register component mounted');
        }
    };
</script>

<style>

</style>