<template>
	<div>
		<a href="#" class="item" @click.prevent="dialogFormVisible = true"> Регистрация</a>

		<el-dialog
			width="30%"
			title="Inner Dialog"
			:visible.sync="innerVisible"
			append-to-body>
			<p>Моля, потвърдете регистрацията си, като кликнете върху линка, изпратен на посочения от Вас и-мейл.</p>
		</el-dialog>

		<el-dialog width="500px" title="Регистрация" :visible.sync="dialogFormVisible">

			<form class="ui form">
  				<h4 class="ui dividing header">Вид акаунт</h4>
  				<div class="field">
  					<div class="two fields">
  						<div class="field">
  							<el-radio v-model="form.publisher" :label="false">
  								Индивидуален потребител
  							</el-radio>
  						</div>
  						<div class="field">
							<el-radio v-model="form.publisher" :label="true">
								Бизнес потребител
							</el-radio>
  						</div>
  					</div>
  				</div>
				
  				<div class="field">
  					<label>Имена</label>
  					<div class="two fields">
  						<div class="field">
  							<input type="text" v-model="form.firstname" placeholder="Име">
  						</div>
  						<div class="field">
  							<input type="text" v-model="form.lastname" placeholder="Фамилия">
  						</div>
  					</div>
  				</div>

  				<div class="field">
					<input type="email" v-model="form.email" placeholder="E-mail">
				</div>

				<div class="two fields">
					<div class="field">
						<input type="password" v-model="form.password" placeholder="Парола">
					</div>
					<div class="field">
						<input type="password" v-model="form.confirmPassword" placeholder="Повторете паролата">
					</div>
				</div>
  			</form>

  			<div class="ui divider"></div>

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
  			</form>
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
        			publisher: vm.form.publisher,
        			event_publish: vm.form.event_publish,
        			venue_publish: vm.form.venue_publish,
        			company_name: vm.form.companyName,
        			slug: vm.form.slug,
        			password: vm.form.password,
        			password_confirmation: vm.form.confirmPassword
        		})
        		.then(function (response) {
        			vm.dialogFormVisible = false;
        			vm.innerVisible = true;
        			setTimeout(function() {
        				location.reload();
        			}, 4000);
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
        	}
        },

        created() {
        	EventBus.$on('registerClicked', () => {
				this.dialogFormVisible = true;
			});
        }
    };
</script>