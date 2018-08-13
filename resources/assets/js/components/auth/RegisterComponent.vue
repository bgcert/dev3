<template>
	<div>
		<a href="#" class="item" @click.prevent="dialogFormVisible = true"> Регистрация</a>

		<el-dialog
			width="30%"
			:visible.sync="innerVisible"
			append-to-body>
			<div class="ui segment">
				<p>Изпратен е линк за потвърждение на <b>{{ form.email }}</b>. За да завършите регистрацията, моля кликнете върху линка. Ако не сте получили писмото за потвърждение в Inbox, моля проверете в Spam директорията.</p>
				<button class="ui basic button" @click="closeConfirm">OK</button>
			</div>
		</el-dialog>

		<el-dialog width="640px" :visible.sync="dialogFormVisible">
			<div class="signup-cover">
				<div>
					<h2>Добре дошли в Seminari365</h2>
					<div class="ui divider"></div>
					<h4>Регистрирайте се, за да продължите напред.</h4>
				</div>
			</div>
			<div class="signup-form">
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
							<label>Съгласявам се с условията за ползване.</label>
						</div>
					</div>
					<button class="ui positive fluid button" @click.prevent="onSubmit">Регистрирай се</button>
				</form>
				

	  			<!-- <div class="ui divider"></div>

	  			<div class="ui yellow message" v-if="form.publisher">
					Използвайте опцията "Бизнес акаунт", ако бизнесът Ви е свързан с организиране на обучения и/или отдаване под наем на конферентни зали, както и други пространства подходящи за реализацията на събития.
				</div>

	  			<form class="ui form" v-if="form.publisher">
	  				<div class="field">
						<input type="text" v-model="form.companyName" placeholder="Име на организацията">
					</div>
					<div class="field">
						<div class="ui labeled right icon input">
							<div class="ui label">
								http://seminari365.com/
							</div>
							<input type="text" v-model="form.slug" placeholder="Адрес на профила (пр: test-ltd)">
						</div>
					</div>

					<h4 class="ui dividing header">Настройка на финкционалност</h4>
	  				<div class="field">
	  					<div class="two fields">
	  						<div class="field">
	  							<el-checkbox v-model="form.event_publish" label="Публикуване на обучения" border></el-checkbox>
	  						</div>
	  						<div class="field">
	  							<el-checkbox v-model="form.venue_publish" label="Публикуване на зали" border></el-checkbox>
	  						</div>
	  					</div>
	  				</div>
	  			</form>

	  			<form class="ui form">
	  				<div class="field">
						<el-checkbox v-model="checked">Съгласявам се с условията за ползване</el-checkbox>
					</div>
					<button class="ui large fluid primary button"  @click="onSubmit" :class="{ loading: loading }">Регистрация</button>
					<div class="ui horizontal divider"> Или</div>
					<button class="ui large fluid basic button" @click.prevent="callLogin">Влезте в профила си</button>
	  			</form> -->
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
        		this.innerVisible == false;
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
	.el-dialog {
		background: url(https://picsum.photos/500/500/?image=347);
		background-size: cover;
    	background-position: center center;
	}

	.el-dialog__header {
		position: absolute;
		z-index: 1;
		top: 0;
		right: 0;
	}

	.el-dialog__body {
		display: flex;
		padding: 0;
	}

	.signup-cover {
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
	}


</style>