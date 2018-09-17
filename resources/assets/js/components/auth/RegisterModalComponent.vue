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
							<template v-if="errors.firstname" v-for="error in errors.firstname">
								 <el-alert type="error" :title="error"></el-alert>
							</template>
							<input type="text" v-model="form.firstname" placeholder="Име">
						</div>
						<div class="field">
							<template v-if="errors.lastname" v-for="error in errors.lastname">
								 <el-alert type="error" :title="error"></el-alert>
							</template>
							<input type="text" v-model="form.lastname" placeholder="Фамилия">
						</div>
					</div>
					
					<div class="field">
						<template v-if="errors.email" v-for="error in errors.email">
							 <el-alert type="error" :title="error"></el-alert>
						</template>
						<input type="email" v-model="form.email" placeholder="E-mail">
					</div>
					<div class="field">
						<template v-if="errors.password" v-for="error in errors.password">
							 <el-alert type="error" :title="error"></el-alert>
						</template>
						<input type="password" v-model="form.password" placeholder="Парола">
					</div>
					<div class="field">
						<template v-if="errors.password_confirmation" v-for="error in errors.password_confirmation">
							 <el-alert type="error" :title="error"></el-alert>
						</template>
						<input type="password" v-model="form.passwordConfirm" placeholder="Повторете паролата">
					</div>
					<div class="field">
						<captcha></captcha>
					</div>
					<button class="ui positive fluid button" @click.prevent="onSubmit">Регистрирай се</button>
					<p>С натискане на бутон "Регистрирай се", Вие се съгласявате с <a href="terms" target="_blank">условията за ползване</a>.</p>
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
        		this.loading = true;
        		let vm = this;

        		try {
					await this.checkCaptcha();
				} catch(e) {
				    return;
				}

        		axios.post('/register', {
        			firstname: vm.form.firstname,
        			lastname: vm.form.lastname,
        			email: vm.form.email,
        			password: vm.form.password,
        			password_confirmation: vm.form.passwordConfirm
        		})
        		.then(function (response) {
        			vm.dialogFormVisible = false;
        			vm.innerVisible = true;
        		})
        		.catch(function (error) {
        			vm.errors = error.response.data.errors;
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

</style>