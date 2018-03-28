<template>
	<div>
	</div>
</template>

<script>
	import { EventBus } from '../app';
    export default {

    	data: function () {
    		return {

    		}
    	},

        mounted() {
            console.log('Flash Component mounted.')
        },

        methods: {
        	flash(message) {
        		this.$message({
        			message: message,
        		});
        	}
        },

        created() {
        	EventBus.$on('flash', (message, type) => {
        		this.$message({
        			message: message,
        			type: type
        		});
        	});
        }
    }
</script>