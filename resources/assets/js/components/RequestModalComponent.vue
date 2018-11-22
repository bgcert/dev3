<template>
	<div>
		<a href="#" :class="classes" @click.prevent="dialogVisible = true">Заяви участие</a>
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
	</div>
</template>

<script>
	import { EventBus } from '../app';
    export default {
    	props: ['id', 'title', 'classes'],

    	data: function () {
    		return {
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
    			let vm = this;
    			this.dialogVisible = false;
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
    				vm.$message({
    					message: 'Заявката е изпратена успешно.',
    					type: 'success'
    				});
	        		console.log(response.data);
				})
				.catch(function (error) {
					vm.$message.error('Възникна грешка при изпращане на заявката.');
					console.log(error);
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
        	var vm = this;
        }
    };
</script>