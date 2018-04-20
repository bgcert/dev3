<template>
	<div>
		<el-dialog
			title="Tips"
			:visible.sync="dialogVisible"
			:before-close="handleClose"
			width="30%">
			<span>{{ message }}</span>
			<span slot="footer" class="dialog-footer">
				<el-button @click="dialogVisible = false">Cancel</el-button>
				<el-button type="primary" @click="dialogVisible = false">Confirm</el-button>
			</span>
		</el-dialog>
		<a href="#" @click.prevent="dialogVisible = true">Request</a>
	</div>
</template>

<script>
	import { EventBus } from '../app';
    export default {
    	props: ['followed', 'company_id'],

    	data: function () {
    		return {
    			dialogVisible: false,
    			message: ''
    		}
    	},

    	methods: {
    		handleClose(done) {
    			this.$confirm('Are you sure to close this dialog?')
    			.then(_ => {
    				done();
    			})
    			.catch(_ => {});
    		}
    	},

        mounted() {
            console.log('Request Modal component mounted.');
        },

        created() {
        	var vm = this;
        	EventBus.$on('testlog', function(message) {
        		vm.dialogVisible = true;
        		vm.message = message;
			});
        }
    }
</script>