<template>
	<div>
		<a href="#" class="btn rounded blue" @click="dialogFormVisible = true"> Вход</a>

		<el-dialog width="30%" title="Вход" :visible.sync="dialogFormVisible">
			<login></login>
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
        			password: vm.form.password
        		})
        		.then(function (response) {
        			console.log(response.data);
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