<template>
	<div class="item">
		<a href="#" @click="dialogFormVisible = true"> Регистрация</a>

		<el-dialog width="400px" :visible.sync="dialogFormVisible">
			<register></register>
		</el-dialog>
	</div>
</template>

<script>
	import { EventBus } from '../../app';
    export default {

    	data: function () {
    		return {
    			innerVisible: false,
    			dialogFormVisible: false,
    			loading: false,
    		}
    	},

        mounted() {
            console.log('Register Component mounted.')
        }
    };
</script>

<style>

</style>