<template>
	<div>
		<div class="ui segment">
			<h2>Messanger</h2>
			<router-view model="model"></router-view>
		</div>
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