<template>
	<div class="item">
		<el-form ref="form" label-position="left" label-width="140px" action="/">
				
			<el-form-item label="E-mail">
				<template v-if="errorMessage.email" v-for="error in errorMessage.email">
					<el-alert
						:title="error"
						type="error"
						show-icon>
					</el-alert>
				</template>
				<el-input type="text" v-model="form.email" name="email"></el-input>
			</el-form-item>
			<el-form-item label="Парола">
				<template v-if="errorMessage.password" v-for="error in errorMessage.password">
					<el-alert
						:title="error"
						type="error"
						show-icon>
					</el-alert>
				</template>
				<el-input type="password" v-model="form.password" name="password"></el-input>
				<el-checkbox v-model="form.checked" name="remember"> Запомни ме</el-checkbox>
			</el-form-item>

			<el-form-item size="large">
				<el-button @click.prevent="callRegister"> Регистрация</el-button>
				<el-button type="primary" @click="onSubmit" :loading="loading"> Вход</el-button>
				<el-button type="text"> Забравена парола.</el-button>
			</el-form-item>
		</el-form>
		
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
        	}
        },
        created() {
        	EventBus.$on('loginClicked', () => {
				this.dialogFormVisible = true;
			});
        }
    };
</script>