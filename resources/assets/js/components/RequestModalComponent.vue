<template>
	<div>
		<div v-if="!auth">
			<a href="#" :class="classes" @click.prevent="login">
				Заявявам участие
			</a>
		</div>
		<div v-else>
			<el-dialog
				title="Заявка"
				:visible.sync="dialogVisible"
				:before-close="handleClose"
				width="25%">
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
										<el-input v-model="companyData.vat" size="small"></el-input>
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
			<a href="#" :class="classes" @click.prevent="dialogVisible = true">Записвам се</a>
		</div>
	</div>
</template>

<script>
	import { EventBus } from '../app';
    export default {
    	props: {
    		id: { required: true },
    		title: { type: [String], required: name },
    		classes: [String, Number]
    	},

    	data: function () {
    		return {
    			auth: window.auth,
    			dialogVisible: false,
    			contactPerson: '',
    			contactNumber: '',
    			participants: [{name: ''}],
    			invoice: false,
    			companyData: {
    				organization: '',
    				cid: null,
    				vat: 'BG',
    				address: '',
    				owner: ''
    			}
    		}
    	},

    	methods: {
    		addField: function() {
    			if (this.participants.length <= 14) {
    				this.participants.push({
	    				name: '',
	    			});
    			}
    		},

    		deleteField: function(index) {
    			this.participants.splice(index, 1);;
    		},

    		sendOrder: function() {
    			this.dialogVisible = false;
    			axios.post('/users/order', {
    				event_id: this.id,
    				contact_person: this.contactPerson,
    				contact_number: this.contactNumber,
    				participants: this.participants,
    				invoice: this.invoice,
    				details: this.companyData
    			})
    			.then(function (response) {
	        		console.log(response.data);
				})
				.catch(function (error) {
					console.log(error);
				});
    		},

    		handleClose(done) {
    			this.$confirm('Are you sure to close this dialog?')
    			.then(_ => {
    				done();
    			})
    			.catch(_ => {});
    		},

    		handleChange(value) {
    			console.log(value)
    		},

    		login() {
    			EventBus.$emit('loginClicked');
    		}
    	},

        mounted() {
            console.log('Request Modal component mounted.');
        },

        created() {
        	var vm = this;
   //      	EventBus.$on('testlog', function(message) {
   //      		vm.dialogVisible = true;
   //      		vm.message = message;
			// });
        }
    };
</script>