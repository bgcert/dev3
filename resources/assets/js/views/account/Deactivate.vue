<template>
	<div>
		<form class="form">
			<div class="field">
				<button class="btn blue" @click.prevent=""> Деактивирай</button>
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
    };
</script>