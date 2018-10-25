<template>
	<div>
		<a href="#" :class="btnClass" @click="dialogVisible = true">{{ buttonText }}</a>
		<el-dialog
			:title="'Запитване'"
			:visible.sync="dialogVisible"
			width="400px">
			<div>
				<form class="ui form">
					<div class="field">
						<template v-if="errors.from" v-for="error in errors.from">
							 <el-alert type="error" :title="error"></el-alert>
						</template>
						<input type="text" v-model="form.from" name="from" placeholder="Лице за контакти">
					</div>
					<div class="field">
						<template v-if="errors.email" v-for="error in errors.email">
							 <el-alert type="error" :title="error"></el-alert>
						</template>
						<input type="email" v-model="form.email" name="email" placeholder="E-mail">
					</div>
					<div class="field">
						<template v-if="errors.phone" v-for="error in errors.phone">
							 <el-alert type="error" :title="error"></el-alert>
						</template>
						<input type="text" v-model="form.phone" name="phone" placeholder="Телефон">
					</div>

					<div class="field">
						<template v-if="errors.subject" v-for="error in errors.subject">
							 <el-alert type="error" :title="error"></el-alert>
						</template>
						<input type="text" v-model="form.subject" name="subject" placeholder="Относно">
					</div>

					<div class="field">
						<template v-if="errors.body" v-for="error in errors.body">
							 <el-alert type="error" :title="error"></el-alert>
						</template>
						<textarea name="body" v-model="form.body" placeholder="Запитване..." rows="4"></textarea>
					</div>
				</form>
			</div>
			<span slot="footer" class="dialog-footer">
				<el-button @click="dialogVisible = false">Откажи</el-button>
				<el-button type="primary" @click="send">Изпрати</el-button>
			</span>
		</el-dialog>
	</div>
</template>

<script>
    export default {
    	props: ['button-text', 'about', 'companyId', 'itemTitle', 'btnClass'],
    	data: function () {
    		return {
    			dialogVisible: false,
    			form: {
    				company_id: this.companyId,
    				about: this.about,
    				from: '',
    				email: '',
    				phone: '',
    				subject: '',
    				body: ''
    			},
    			errors: []
    		}
    	},

        methods: {
        	send() {
        		let vm = this;

        		axios.post('/api/contact/form', vm.form)
    			.then(function (response) {
    				console.log(response);
    				vm.$message('Запитването е изпратено успешно.');
    				vm.dialogVisible = false;
    			})
    			.catch(function (error) {
    				console.log(error.response);
    				vm.errors = error.response.data.errors;
    			})
        	}
        },

        mounted() {
            console.log('Contact Publisher Component mounted.')
        },

        created() {
        	
        }
    };
</script>

<style>
	
</style>