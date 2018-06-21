<template>
	<div>
		<div v-if="!auth">
			<a href="#" :class="classes" @click.prevent="login">
				Записвам се
			</a>
		</div>
		<div v-else>
			<el-dialog
				title="Заявка"
				:visible.sync="dialogVisible"
				:before-close="handleClose"
				width="30%">
					<div>
						<el-form ref="form" label-width="30%">
							<el-form-item label="Количество">
								<el-input-number v-model="qty" @change="handleChange" :min="1" :max="10"></el-input-number>
							</el-form-item>
							<el-form-item label="Фактура">
								<el-checkbox v-model="invoice" name="type"></el-checkbox>
							</el-form-item>
						</el-form>
					</div>
					<span slot="footer" class="dialog-footer">
						<el-button @click="dialogVisible = false">Откажи</el-button>
						<el-button type="primary" @click="dialogVisible = false">Заяви</el-button>
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
    		auth: { type: [String, Number], required: true},
    		classes: [String, Number]
    	},

    	data: function () {
    		return {
    			dialogVisible: false,
    			qty: 1,
    			invoice: false,
    		}
    	},

    	methods: {
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