<template>
	<div v-if="showModal">
		<div class="modal fade" id="contactPublisherModal" tabindex="-1" role="dialog" aria-labelledby="contactPublisherModal" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Запитване</h5>
						<button type="button" class="close" aria-label="Close" @click.prevent="closeModal">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<div class="form-group">
							<input type="text" name="name" class="form-control" placeholder="Лице за контакти" v-model="form.from">
						</div>

						<div class="form-group">
							<input type="email" name="email" class="form-control" placeholder="E-mail" v-model="form.email">
						</div>

						<div class="form-group">
							<input type="text" name="phone" class="form-control" placeholder="Телефон" v-model="form.phone">
						</div>

						<div class="form-group">
							<input type="text" name="subject" class="form-control" placeholder="Относно" v-model="form.subject">
						</div>

						<div class="form-group">
							<label>Запитване</label>
							<textarea name="subject" class="form-control" v-model="form.body"></textarea>
						</div>

						<div class="form-group text-right">
							<button class="btn btn-outline-secondary" @click.prevent="closeModal">Откажи</button>
							<button class="btn btn-primary" @click.prevent="send">Изпрати</button>
							<!-- <span slot="footer" class="dialog-footer">
								<el-button @click="dialogVisible = false">Откажи</el-button>
								<el-button type="primary" @click="send">Изпрати</el-button>
							</span> -->
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	<!-- <div>
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
	</div> -->
</template>

<script>
	import { EventBus } from '../app';
    export default {
    	props: ['about', 'companyId', 'itemTitle'],
    	data: function () {
    		return {
    			showModal: false,
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
        	openModal() {
				this.showModal = true;
				Vue.nextTick(function () {
				  $('#contactPublisherModal').modal('show');
				})
			},

			closeModal() {
				$('#contactPublisherModal').modal('hide').promise().done(function(){
				    this.showModal = false;
				});
			},

        	send() {
        		let vm = this;

        		axios.post('/api/contact/form', vm.form)
    			.then(function (response) {
    				vm.$message('Запитването е изпратено успешно.');
    				vm.closeModal();
    			})
    			.catch(function (error) {
    				console.log(error.response);
    				vm.errors = error.response.data.errors;
    				vm.closeModal();
    			})
        	}
        },

        mounted() {
            console.log('Contact Publisher Component mounted.')
        },

        created() {
        	EventBus.$on('contactPublisherClicked', () => {
				this.openModal();
			});
        }
    };
</script>

<style>
	
</style>