<template>
	<div class="form">
		<template v-if="errorMessage.email" v-for="error in errorMessage.email">
			<el-alert
				:title="error"
				type="error"
				show-icon>
			</el-alert>
		</template>
		<div>
			<input type="text" v-model="form.email" name="email" placeholder="E-mail" autofocus @keyup.enter="onSubmit">
		</div>

		<template v-if="errorMessage.password" v-for="error in errorMessage.password">
			<el-alert
				:title="error"
				type="error"
				show-icon>
			</el-alert>
		</template>
		<div class="field">
			<input type="password" v-model="form.password" name="password" placeholder="Парола" @keyup.enter="onSubmit">	
		</div>
		
		<div class="field">
			<input type="checkbox" name="remember" v-model="form.checked"> Запомни ме
		</div>
		
		<a href="/register" class="btn basic"> Регистрация</a>
		<a href="#" class="btn blue" @click="onSubmit" :loading="loading"> Вход</a>
		<a href="#" @click="callReset"> Забравена парола.</a>		
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