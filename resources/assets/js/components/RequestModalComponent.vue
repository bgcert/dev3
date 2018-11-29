<template>
	<div v-if="showModal">
		<div class="modal fade" id="requestModal" tabindex="-1" role="dialog" aria-labelledby="requestModal" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Заявка</h5>
						<button type="button" class="close" aria-label="Close" @click.prevent="closeModal">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<h5 class="mb-3">Тема: {{ title }}</h5>

						<div class="form-group">
		    				<input type="text" name="contact_person" class="form-control" placeholder="Лице за контакт" v-model="contactPerson">
						</div>

						<div class="form-group">
		    				<input type="text" name="phone" class="form-control" placeholder="Телефон" v-model="contactNumber">
						</div>

						<div class="form-group">
		    				<input type="email" name="email" class="form-control" placeholder="E-mail" v-model="contactEmail">
						</div>

						<div class="form-group">
							<label>Участници</label>
							<template v-for="(pariticipant, index) in participants">
								<div class="input-group mb-3">
									<input type="text" name="participant" class="form-control" v-model="pariticipant.name" :placeholder="'Име на участник ' + (index + 1)">
									<div class="input-group-append">
										<button class="btn btn-danger" :class="{ disabled: participants.length <= 1 }" @click.prevent="removeField(index)">
											<i class="far fa-trash-alt"></i>
										</button>
									</div>
								</div>	
							</template>
						</div>

						<div class="form-group text-right">
							<button class="btn btn-primary" :class="{ disabled: participants.length == 15 }" @click="addField">+ Добави участник</button>
						</div>
						<hr>

						<div class="custom-control custom-checkbox mb-3">
							<input type="checkbox" class="custom-control-input" id="invoice-check" v-model="invoice">
							<label class="custom-control-label" for="invoice-check">Желая да ми бъде издадена фактура</label>
						</div>

						<template v-if="invoice">
							<h5>Данни за фактура</h5>
							<div class="form-group">
								<input type="text" name="company" class="form-control" placeholder="Организация" v-model="companyData.organization">
							</div>

							<div class="form-group">
								<input type="text" name="cid" class="form-control" placeholder="ЕИК" v-model="companyData.cid">
							</div>

							<div class="form-group">
								<input type="text" name="vat" class="form-control" placeholder="ДДС номер" v-model="companyData.vat">
							</div>

							<div class="form-group">
								<label>Адрес</label>
								<textarea name="address" class="form-control" v-model="companyData.address"></textarea>
							</div>

							<div class="form-group">
								<input type="text" name="owner" class="form-control" placeholder="МОЛ" v-model="companyData.owner">
							</div>
						</template>
						<div class="form-group">
							<div class="text-right">
								<button class="btn btn-outline-primary" @click.prevent="closeModal">Откажи</button>
								<button class="btn btn-primary" @click="sendRequest">Заяви</button>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>

		<!-- <div>
			<el-dialog
				title="Заявка"
				:visible.sync="dialogVisible"
				:before-close="handleClose">

					<div>
						<h3>Тема: {{ title }}</h3>
						<el-form ref="form" label-width="30%">
							<div class="ui vertical segment">
								<el-form-item>
									<el-input placeholder="Лице за контакт" v-model="contactPerson"></el-input>
								</el-form-item>
								<el-form-item>
									<el-input placeholder="Телефон" v-model="contactNumber"></el-input>
								</el-form-item>
								<el-form-item>
									<el-input placeholder="E-mail" v-model="contactEmail"></el-input>
								</el-form-item>
							</div>
							<div class="ui basic segment">
								<h4>Участници</h4>
								<template v-for="(pariticipant, index) in participants">
									<el-form-item>
										<el-input :placeholder="'Участник ' + (index+1)" v-model="pariticipant.name" size="small">
											<el-button type="primary" icon="el-icon-delete" slot="append" @click="deleteField(index)"></el-button>
										</el-input>
									</el-form-item>
								</template>
								<el-form-item>
									<el-button type="primary" icon="el-icon-plus" @click="addField"></el-button>
								</el-form-item>
								<el-form-item label="Фактура">
									<el-checkbox v-model="invoice" name="type"></el-checkbox>
								</el-form-item>
								<template v-if="invoice">
									<h4>Данни за фактура</h4>
									<el-form-item label="Организация">
										<el-input placeholder="Организация" v-model="companyData.organization" size="small"></el-input>
									</el-form-item>
									<el-form-item label="ЕИК">
										<el-input placeholder="ЕИК" v-model="companyData.cid" size="small"></el-input>
									</el-form-item>
									<el-form-item label="ДДС номер">
										<el-input
											v-model="companyData.vat"
											size="small">
											<template slot="prepend">BG</template>			
										</el-input>
									</el-form-item>
									<el-form-item label="Адрес">
										<el-input type="textarea" v-model="companyData.address"></el-input>
									</el-form-item>
									<el-form-item label="МОЛ">
										<el-input placeholder="МОЛ" v-model="companyData.owner" size="small"></el-input>
									</el-form-item>
								</template>
							</div>
						</el-form>
					</div>
					<span slot="footer" class="dialog-footer">
						<el-button @click="dialogVisible = false">Откажи</el-button>
						<el-button type="primary" @click="sendOrder">Заяви</el-button>
					</span>
			</el-dialog>
		</div> -->
	</div>



	
</template>

<script>
	import { EventBus } from '../app';
    export default {
    	props: ['id', 'title'],

    	data: function () {
    		return {
    			showModal: false,
    			auth: window.auth,
    			dialogVisible: false,
    			contactPerson: '',
    			contactNumber: '',
    			contactEmail: '',
    			participants: [{name: ''}],
    			invoice: false,
    			companyData: {
    				organization: '',
    				cid: null,
    				vat: null,
    				address: '',
    				owner: ''
    			}
    		}
    	},

    	methods: {
    		openModal() {
				this.showModal = true;
				Vue.nextTick(function () {
				  $('#requestModal').modal('show');
				})
			},

			closeModal() {
				$('#requestModal').modal('hide').promise().done(function(){
				    this.showModal = false;
				});
			},

    		addField: function() {
    			if (this.participants.length <= 14) {
    				this.participants.push({
	    				name: '',
	    			});
    			}
    		},

    		removeField: function(index) {
    			this.participants.splice(index, 1);
    		},

    		sendRequest: function() {
    			let vm = this;
    			axios.post('/order', {
    				event_id: this.id,
					contact_person: this.contactPerson,
    				contact_number: this.contactNumber,
    				contact_email: this.contactEmail,
    				invoice: this.invoice,
    				participants: this.participants,
    				details: this.companyData
    			})
    			.then(function (response) {
    				vm.closeModal();
    				vm.$message({
    					message: 'Заявката е изпратена успешно.',
    					type: 'success'
    				});
				})
				.catch(function (error) {
					vm.$message.error('Възникна грешка при изпращане на заявката.');
					vm.closeModal();
				});
    		},

    		handleClose(done) {
    			this.$confirm('Сигурни ли сте, че желаете да затворите заявката?')
    			.then(_ => {
    				done();
    			})
    			.catch(_ => {});
    		},

    		handleChange(value) {
    			console.log(value)
    		}
    	},

        mounted() {
            console.log('Request Modal component mounted.');
        },

        created() {
        	EventBus.$on('requestClicked', () => {
				this.openModal();
			});
        }
    };
</script>