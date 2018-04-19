<template>
	<div>
		<button class="ui basic button" @click="dialogFormVisible = true"> Вход</button>

		<el-dialog width="30%" title="Регистрация" :visible.sync="dialogFormVisible">

			<el-form ref="form" label-position="left" label-width="140px">
				<el-form-item label="E-mail">
					<el-input v-model="form.email"></el-input>
				</el-form-item>
				<el-form-item label="Парола">
					<el-input v-model="form.password"></el-input>
					<el-checkbox v-model="form.checked"> Запомни ме</el-checkbox>
				</el-form-item>
				
				<a href="#"> </a>

				<el-form-item size="large">
					<el-button type="plain" @click="onSubmit"> Региистрирай се</el-button>
					<el-button type="primary" @click="onSubmit"> Вход</el-button>
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
        		console.log('submit!');
        	}
        },

        created() {
        	
        }
    }
</script>