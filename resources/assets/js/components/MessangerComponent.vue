<template>
	<div>
		<router-view></router-view>
	</div>
</template>

<script>
    export default {
    	data: function () {
    		return {
    			
    		}
    	},

    	methods: {

    	},

        mounted() {
            console.log('Messanger Component mounted.')
        }
    };
</script>