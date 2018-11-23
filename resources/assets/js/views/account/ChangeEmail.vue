<template>
	<div class="form col-lg-4 col-sm-12">
		<div class="form-group">
			<label>Нов email</label>
			<input type="text" class="form-control" v-model="form.email" value="" autocomplete="new-password">
		</div>

		<div class="form-group">
			<label>Парола</label>
			<input type="password" class="form-control" v-model="form.password" value="" autocomplete="new-password">
		</div>

		<div class="form-group">
			<button class="btn btn-primary"  @click.prevent="changeEmail"> Промени</button>
		</div>
	</div>
</template>

<script>
	import { EventBus } from '../../app';
    export default {
    	data: function () {
    		return {
    			form: {
    				publisher: false,
	    			user: {

	    			},
	    			oldPassword: '',
					newPassword: '',
					confirmNewPassword: '',
					email: '',
					password: ''
    			},
    			company: {
    				name: '',
    				slug: '',
    				event_publish: false,
    				venue_publish: false
				}
    		}
    	},

    	methods: {
    		changeEmail() {
    			console.log('button press');
    		}
    	},

        mounted() {
            console.log('ChangeEmail view mounted.')
        },

        created() {

        }
    }
</script>