<template>
	<div class="form col-lg-4 col-sm-12">
		<h3>Изтриване на акаунт</h3>

		<div class="form-group">
			<label>Password</label>
			<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
		</div>

		<div class="form-group">
			<button class="btn btn-danger btn-lg" @click.prevent=""> Изтрий</button>
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

    	},

        mounted() {
            console.log('Deactivate view mounted.')
        },

        created() {

        }
    };
</script>