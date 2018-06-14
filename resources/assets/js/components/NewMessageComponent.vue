<template>
	<span>
		<template v-if="!auth">
			<a href="#" @click.prevent="login">
				Записвам се
			</a>
		</template>
		<template v-else>
			<el-dialog
				title="Ново съобщение"
				:visible.sync="dialogVisible"
				:before-close="handleClose"
				width="30%">
				<span>
					<el-input type="textarea"></el-input>
				</span>
				<span slot="footer" class="dialog-footer">
					<el-button @click="dialogVisible = false">Откажи</el-button>
					<el-button type="primary" @click="dialogVisible = false">Изпрати</el-button>
				</span>
			</el-dialog>
			<a class="mini ui orange button" href="#" @click.prevent="dialogVisible = true"><i class="paper plane icon"></i> Изпрати съобщение</a>
		</template>
	</span>
</template>

<script>
	import { EventBus } from '../app';
    export default {
    	props: {
    		auth: { type: [Boolean], required: true},
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
            console.log('New message component mounted.');
        },

        created() {

        }
    };
</script>