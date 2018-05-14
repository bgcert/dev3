<template>
	<div>
		<template v-if="!auth">
			<a href="#" :class="classes" @click.prevent="login">
				Записвам се
			</a>
		</template>
		<template v-else>
			<el-dialog
				title="Заявка"
				:visible.sync="dialogVisible"
				:before-close="handleClose"
				width="30%">
				<span>
					
				</span>
				<span slot="footer" class="dialog-footer">
					<el-button @click="dialogVisible = false">Cancel</el-button>
					<el-button type="primary" @click="dialogVisible = false">Confirm</el-button>
				</span>
			</el-dialog>
			<a href="#" :class="classes" @click.prevent="dialogVisible = true">Записвам се</a>
		</template>
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
    }
</script>