<template>
	<div>
		<form class="ui form">

			<div class="field">
				<button class="ui basic big negative button" @click.prevent=""> Деактивирай</button>
			</div>
			
		</form>

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
    }
</script>