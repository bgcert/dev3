<template>
	<div>
		<a href="#" class="item" @click="dialogFormVisible = true"> Вход</a>

		<el-dialog width="30%" title="Регистрация" :visible.sync="dialogFormVisible">

			<el-form ref="form" label-position="left" label-width="140px">
				<el-form-item label="E-mail">
					<el-input v-model="form.email" name="email"></el-input>
				</el-form-item>
				<el-form-item label="Парола">
					<el-input v-model="form.password" name="password"></el-input>
					<el-checkbox v-model="form.checked"> Запомни ме</el-checkbox>
				</el-form-item>

				<el-form-item size="large">
					<el-button @click.prevent="callRegister"> Регистрация</el-button>
					<el-button type="primary" @click="onSubmit" :loading="loading"> Вход</el-button>
					<el-button type="text"> Забравена парола.</el-button>
				</el-form-item>
			</el-form>

		</el-dialog>
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
    			}
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
        			password: vm.form.password
        		})
        		.then(function (response) {
        			console.log(response.data);
        			vm.dialogFormVisible = false;
        			location.reload();
        		})
        		.catch(function (error) {
        			console.log(error);
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
    }
</script>