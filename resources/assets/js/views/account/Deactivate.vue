<template>
	<div class="form col-lg-6 col-sm-12">
		<h3 class="mb-3">Изтриване на акаунт</h3>

		<div class="alert alert-warning" role="alert">
			<h4 class="alert-heading">Внимание!</h4>
			Изтриването на акаунт е необратим процес! След потвърждаване на изтриването, всички данни въведени от Вас ще бъдат заличени от базата данни на Seminari365.
		</div>

		<div class="form-group">
			<input type="password" class="form-control" id="exampleInputPassword1" placeholder="Парола">
			<small id="emailHelp" class="form-text text-muted">За да изтриете акаунта е необходимо да въветете Вашата парола.</small>
		</div>

		<div class="form-group">
			<button class="btn btn-danger btn-lg" @click.prevent="deleteAccount"> Изтрий</button>
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
    		deleteAccount() {
    			console.log('test');
    		}
    	},

        mounted() {
            console.log('Deactivate view mounted.');
        },

        created() {

        }
    };
</script>