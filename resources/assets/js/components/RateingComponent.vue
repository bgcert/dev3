<template>
	<div>
		<el-rate
			v-model="rate"
			disabled
			text-color="#ff9900"
			score-template="{value}">
		</el-rate>
	</div>
</template>

<script>
    export default {
    	props: ['rateing'],
    	data: function () {
    		return {
    			rate: this.rateing
    		}
    	},

        mounted() {
            console.log('Rating Component mounted.')
        }
    };
</script>

