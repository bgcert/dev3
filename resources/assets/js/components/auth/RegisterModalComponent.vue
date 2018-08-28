<template>
	<div class="item">
		<button class="ui basic orange button" @click.prevent="dialogFormVisible = true"> Регистрация</button>

		<el-dialog
			width="30%"
			@close="closeConfirm"
			:visible.sync="innerVisible"
			append-to-body>
			<p>Изпратен е линк за потвърждение на <b>{{ form.email }}</b>. За да завършите регистрацията, моля кликнете върху линка. Ако не сте получили писмото за потвърждение в Inbox, моля проверете в Spam директорията.</p>
			<button class="ui basic button" @click="closeConfirm">OK</button>
		</el-dialog>

		<el-dialog width="400px" :visible.sync="dialogFormVisible">
			<div class="signup-cover">
				<div>
					<h2>Добре дошли в Seminari365</h2>
					<div class="ui divider"></div>
					<h4>Регистрирайте се, за да продължите напред.</h4>
				</div>
			</div>
			<div class="signup-form mt-20">
				<form class="ui form">
					<div class="fields">
						<div class="field">
							<input type="text" v-model="form.firstname" placeholder="Име">
						</div>
						<div class="field">
							<input type="text" v-model="form.lastname" placeholder="Фамилия">
						</div>
					</div>
					
					<div class="field">
						<input type="email" v-model="form.email" placeholder="E-mail">
					</div>
					<div class="field">
						<input type="password" v-model="form.password" placeholder="Парола">
					</div>
					<div class="field">
						<input type="password" v-model="form.passwordConfirm" placeholder="Повторете паролата">
					</div>
					<div class="field">
						<div class="ui checkbox">
							<input type="checkbox" tabindex="0" class="hidden">
							<label>Съгласявам се с <a href="terms" target="_blank">условията за ползване.</a></label>
						</div>
					</div>
					<button class="ui positive fluid button" @click.prevent="onSubmit">Регистрирай се</button>
				</form>
			</div>
			
		</el-dialog>
	</div>
</template>

<script>
	import { EventBus } from '../../app';
    export default {

    	data: function () {
    		return {
    			innerVisible: false,
    			dialogFormVisible: false,
    			loading: false,
    			checked: false,
    			form: {
    				firstname: '',
    				lastname: '',
    				email: '',
    				publisher: false,
    				event_publish: true,
    				venue_publish: false,
    				password: '',
    				passwordConfirm: '',
    				companyName: '',
    				slug: ''
    			}
    		}
    	},

        mounted() {
            console.log('Register Component mounted.')
        },

        methods: {
        	onSubmit() {
        		this.loading = true;
        		let vm = this;
        		axios.post('/register', {
        			firstname: vm.form.firstname,
        			lastname: vm.form.lastname,
        			email: vm.form.email,
        			// publisher: vm.form.publisher,
        			// event_publish: vm.form.event_publish,
        			// venue_publish: vm.form.venue_publish,
        			// company_name: vm.form.companyName,
        			// slug: vm.form.slug,
        			password: vm.form.password,
        			password_confirmation: vm.form.passwordConfirm
        		})
        		.then(function (response) {
        			vm.dialogFormVisible = false;
        			vm.innerVisible = true;
        		})
        		.catch(function (error) {
        			console.log(error);
        		});
        	},

        	callLogin() {
        		this.dialogFormVisible = false;
        		setTimeout( function(){
					EventBus.$emit('loginClicked');
				}, 300 );
        	},

        	closeConfirm() {
        		this.innerVisible = false;
        		location.reload();
        	}
        },

        created() {
        	EventBus.$on('registerClicked', () => {
				this.dialogFormVisible = true;
			});
        }
    };
</script>

<style>
/*	.el-dialog__header {
		position: absolute;
		top: 0;
		right: 0;
	}

	.el-dialog__body {
		display: flex;
		padding: 0;
	}

	.signup-cover {
		background: url(https://picsum.photos/500/500/?image=347);
		background-size: cover;
    	background-position: center center;
		padding: 50px 30px;
		flex: 5;
		display: flex;
		align-items: center;
		justify-content: center
	}

	.signup-form {
		padding: 50px 30px;
		background-color: white;
		flex: 7;
	}*/


</style>