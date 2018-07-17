<template>
	<div>
		<a href="#" class="item" @click.prevent="dialogFormVisible = true"> Регистрация</a>

		<el-dialog
			width="30%"
			title="Inner Dialog"
			:visible.sync="innerVisible"
			append-to-body>
			<h3>Моля, потвърдете регистрацията си, като кликнете върху линка, изпратен на посочения от Вас и-мейл.</h3>
		</el-dialog>

		<el-dialog width="30%" title="Регистрация" :visible.sync="dialogFormVisible">

			<el-form ref="form" label-position="left" label-width="180px">
				<el-form-item label="Име">
					<el-input v-model="form.name"></el-input>
				</el-form-item>

				<el-form-item label="E-mail">
					<el-input v-model="form.email"></el-input>
				</el-form-item>
				<el-form-item label="Парола">
					<el-input v-model="form.password"></el-input>
				</el-form-item>
				<el-form-item label="Потвърдете паролата">
					<el-input v-model="form.confirmPassword"></el-input>
				</el-form-item>

				<el-form-item label="Организация">
					<el-switch v-model="form.publisher"></el-switch>
				</el-form-item>

				<template v-if="form.publisher">
					<el-form-item label="Име на организацията">
						<el-input v-model="form.companyName"></el-input>
					</el-form-item>
					<el-form-item label="Адрес">
						<el-input size="medium" placeholder="Въведете адрес" v-model="form.slug">
							<template slot="prepend">http://seminari365.com/</template>
						</el-input>
					</el-form-item>

					<el-form-item label="Публикуване на обучения">
						<el-switch v-model="form.event_publish"></el-switch>
					</el-form-item>

					<el-form-item label="Публикуване на събития">
						<el-switch v-model="form.venue_publish"></el-switch>
					</el-form-item>

				</template>
				<el-form-item size="large">
					<el-button @click.prevent="callLogin"> Вход</el-button>
					<el-button type="primary" @click="onSubmit" :loading="loading">Регистрация</el-button>
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
    			innerVisible: false,
    			dialogFormVisible: false,
    			loading: false,
    			form: {
    				name: '',
    				email: '',
    				publisher: false,
    				event_publish: true,
    				venue_publish: false,
    				activities: [],
    				password: '',
    				passwordConfirm: '',
    				companyName: '',
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
        			name: vm.form.name,
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