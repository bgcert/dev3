<template>
	<div class="form" v-loading="loading">
		<form>
			<div class="form-group">
				<label>Email адрес</label>
				<input
					type="email"
					class="form-control"
					:class="{ 'is-invalid': errorMessage.email }"
					v-model="form.email"
					name="email"
					aria-describedby="emailHelp"
					placeholder="Въведете E-mail"
					autofocus
					required
					@keyup.enter="onSubmit">

				<div class="invalid-feedback" v-if="errorMessage.email">
					{{ errorMessage.email[0] }}
				</div>
				<!-- <small id="emailHelp" class="form-text text-muted">We'll never share your email with anyone else.</small> -->
			</div>

			<div class="form-group">
				<label>Парола</label>
				<input
					type="password"
					class="form-control"
					:class="{ 'is-invalid': errorMessage.password }"
					v-model="form.password"
					name="password"
					required
					placeholder="Въведете парола">

				<div class="invalid-feedback" v-if="errorMessage.password">
					{{ errorMessage.password[0] }}
				</div>
			</div>

			<div class="form-group form-check">
				<input type="checkbox" class="form-check-input" name="remember" v-model="form.checked" id="rememberMe">
				<label class="form-check-label" for="rememberMe">Запомни ме</label>
			</div>

			<a href="/register" class="btn btn-outline-primary">Регистрация</a>
			<button type="submit" class="btn btn-primary" @click.prevent="onSubmit" :loading="loading">Вход</button>
			<button class="btn btn-link" @click.prevent="callReset"> Забравена парола.</button>
		</form>
	</div>
</template>

<script>
	import { EventBus } from '../../app';
    export default {
    	data: function () {
    		return {
    			dialogFormVisible: false,
    			loading: false,
    			form: {
    				email: '',
    				password: '',
    				checked: true
    			},
    			errorMessage: ''
    		}
    	},

        mounted() {
            console.log('Login Component mounted.')
        },

        methods: {
        	onSubmit() {
        		this.loading = true;
        		let vm = this;
        		axios.post('/login', {
        			email: vm.form.email,
        			password: vm.form.password,
        			remember: vm.checked
        		})
        		.then(function (response) {
        			window.location.reload();
        		})
        		.catch(function (error) {
        			vm.loading = false;
        			vm.errorMessage = error.response.data.errors;
        		});
        	},

        	callRegister() {
        		this.dialogFormVisible = false;
        		setTimeout( function(){
					EventBus.$emit('registerClicked');
				}, 300 );
        	},

        	callReset() {
        		window.location.href = '/password/reset';
        	}
        },
        created() {
        	EventBus.$on('loginClicked', () => {
				this.dialogFormVisible = true;
			});
        }
    };
</script>