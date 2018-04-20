<template>
	<div>
		<a href="#" class="item" @click.prevent="dialogFormVisible = true"> Регистрация</a>

		<el-dialog width="30%" title="Регистрация" :visible.sync="dialogFormVisible">
			<el-form ref="form" label-position="left" label-width="180px">
				<el-form-item label="Име">
					<el-input v-model="form.name"></el-input>
				</el-form-item>
				<el-form-item label="Организация">
					<el-switch v-model="form.type"></el-switch>
				</el-form-item>
				<template v-if="form.type">
					<el-form-item label="Име на организацията">
						<el-input v-model="form.organizationName"></el-input>
					</el-form-item>
					<el-form-item label="Адрес">
						<el-input size="medium" placeholder="Въведете адрес" v-model="form.skug">
							<template slot="prepend">http://seminari365.com/</template>
						</el-input>
					</el-form-item>

					<el-form-item label="Желая да:">
						<el-checkbox-group size="small" v-model="form.activities">
							<el-checkbox-button label="events" name="event">Публикувам обучения</el-checkbox-button>
							<el-checkbox-button label="venues" name="venue">Публикувам зали</el-checkbox-button>
						</el-checkbox-group>
					</el-form-item>

				</template>

				<el-form-item label="E-mail">
					<el-input v-model="form.email"></el-input>
				</el-form-item>
				<el-form-item label="Парола">
					<el-input v-model="form.password"></el-input>
				</el-form-item>
				<el-form-item label="Потвърдете паролата">
					<el-input v-model="form.confirmPassword"></el-input>
				</el-form-item>
				<el-form-item size="large">
					<el-button @click.prevent="callLogin"> Вход</el-button>
					<el-button type="primary" @click="onSubmit">Регистрация</el-button>
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
    			form: {
    				name: '',
    				email: '',
    				type: false,
    				activities: [],
    				password: '',
    				confirmPassword: ''
    			},
    		}
    	},

        mounted() {
            console.log('Register Component mounted.')
        },

        methods: {
        	onSubmit() {
        		console.log('submit!');
        	},

        	callLogin() {
        		this.dialogFormVisible = false;
        		setTimeout( function(){
					EventBus.$emit('loginClicked');
				}, 500 );
        	}
        },

        created() {
        	EventBus.$on('registerClicked', () => {
				this.dialogFormVisible = true;
			});
        }
    }
</script>