<template>
	<div>
		<button class="ui button" :class="btnClass" @click="dialogVisible = true">Пишете ни</button>

		<!-- <el-button type="text" @click="dialogVisible = true">click to open the Dialog</el-button> -->

		<el-dialog
			:title="'Запитване за:' + itemTitle"
			:visible.sync="dialogVisible"
			width="400px">
			<div>
				<form class="ui form">
					<div class="field">
						<input type="text" v-model="form.from" name="from" placeholder="Име">
					</div>
					<div class="field">
						<input type="email" v-model="form.email" name="email" placeholder="E-mail">
					</div>
					<div class="field">
						<input type="text" v-model="form.phone" name="phone" placeholder="Телефон">
					</div>

					<div class="field">
						<input type="text" v-model="form.subject" name="subject" placeholder="Относно">
					</div>

					<div class="field">
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
    	props: ['companyId', 'itemTitle', 'btnClass'],
    	data: function () {
    		return {
    			dialogVisible: false,
    			form: {
    				company_id: this.companyId,
    				title: this.itemTitle,
    				from: '',
    				email: '',
    				phone: '',
    				subject: '',
    				body: ''
    			}
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
    				// vm.errors = error.response.data;
    			})
        	}
        },

        mounted() {
            console.log('Contact Us Component mounted.')
        },

        created() {
        	
        }
    };
</script>

<style>
	
</style>