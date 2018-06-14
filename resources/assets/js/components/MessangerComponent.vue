<template>
	<div>
		<h2>Messanger</h2>
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