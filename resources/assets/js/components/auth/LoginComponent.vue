<template>
	<div class="form">
		<form>
			<div class="form-group">
				<label for="exampleInputEmail1">Email адрес</label>
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
			<button type="submit" class="btn btn-primary" @click="onSubmit" :loading="loading">Вход</button>
			<button class="btn btn-link" @click.prevent="callReset"> Забравена парола.</button>
		</form>


		<!-- <template v-if="errorMessage.email" v-for="error in errorMessage.email">
			<el-alert
				:title="error"
				type="error"
				show-icon>
			</el-alert>
		</template> -->
		<!-- <div>
			<input type="text" v-model="form.email" name="email" placeholder="E-mail" autofocus @keyup.enter="onSubmit">
		</div> -->

		<!-- <template v-if="errorMessage.password" v-for="error in errorMessage.password">
			<el-alert
				:title="error"
				type="error"
				show-icon>
			</el-alert>
		</template> -->
		<!-- <div class="field">
			<input type="password" v-model="form.password" name="password" placeholder="Парола" @keyup.enter="onSubmit">	
		</div> -->
		
		<!-- <div class="field">
			<input type="checkbox" name="remember" v-model="form.checked"> Запомни ме
		</div> -->
		
		<!-- <a href="/register" class="btn basic"> Регистрация</a>
		<a href="#" class="btn blue" @click="onSubmit" :loading="loading"> Вход</a>
		<a href="#" @click="callReset"> Забравена парола.</a>		 -->
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
        			vm.dialogFormVisible = false;
        			window.location.reload();
        		})
        		.catch(function (error) {
        			vm.loading = false;
        			vm.errorMessage = error.response.data.errors;
        		});
        		console.log('submit!');
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