<template>
	<div class="form col-lg-4 col-sm-12">
		<div class="field">
			<button class="btn btn-danger btn-lg" @click.prevent=""> Деактивирай</button>
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