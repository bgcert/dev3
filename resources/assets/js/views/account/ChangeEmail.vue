<template>
	<div>
		<form class="ui form">
			<div class="field">
				<label>Нов email</label>
				<input type="text" v-model="form.email" value="" autocomplete="new-password">
			</div>
			<div class="field">
				<label>Парола</label>
				<input type="password" v-model="form.password" value="" autocomplete="new-password">
			</div>
			<div class="field">
				<button class="ui basic button" @click.prevent="changeEmail"> Промени</button>
			</div>
			
		</form>

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