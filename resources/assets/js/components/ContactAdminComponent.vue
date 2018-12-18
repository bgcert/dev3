<template>
	<div v-if="showModal">
		<div class="modal fade" id="contactAdminModal" tabindex="-1" role="dialog" aria-labelledby="contactAdminModal" aria-hidden="true">
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
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import { EventBus } from '../app';
    export default {
    	data: function () {
    		return {
    			showModal: false,
    			form: {
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
				  $('#contactAdminModal').modal('show');
				})
			},

			closeModal() {
				$('#contactAdminModal').modal('hide').promise().done(function(){
				    this.showModal = false;
				});
			},

        	send() {
        		let vm = this;

        		axios.post('/api/admin/contact/form', vm.form)
    			.then(function (response) {
    				vm.$message('Запитването е изпратено успешно.');
    				vm.closeModal();
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
        	EventBus.$on('contactAdminClicked', (subject) => {
        		this.form.subject = subject;
				this.openModal();
			});
        }
    };
</script>

<style>
	
</style>