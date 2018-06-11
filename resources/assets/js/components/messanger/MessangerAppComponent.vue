<template>
	<div>
		<div class="ui segment">
			
		</div>
	</div>
</template>

<script>
	import { EventBus } from '../../app';
    export default {

    	data: function () {
    		return {

    		}
    	},

        methods: {
        	// flash(message) {
        	// 	this.$message({
        	// 		message: message,
        	// 	});
        	// }
        },

        mounted() {
            console.log('Messanger App Component mounted.')
        },

        created() {
        	// EventBus.$on('flash', (message, type) => {
        	// 	this.$message({
        	// 		message: message,
        	// 		type: type
        	// 	});
        	// });
        }
    };
</script>