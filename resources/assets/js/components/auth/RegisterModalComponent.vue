<template>
	<div class="nav-item">
		<modal v-if="showModal">
			<div slot="body">
				<register></register>
			</div>
		</modal>
	</div>
</template>

<script>
	import { EventBus } from '../../app';
    export default {

    	data: function () {
    		return {
    			showModal: false
    		}
    	},

        mounted() {
            console.log('Register Component mounted.');
        },

        created() {
        	EventBus.$on('registerClicked', () => {
				this.showModal = true;
			});

			EventBus.$on('closeModal', () => {
				this.showModal = false;
			});
        }
    };
</script>

<style>

</style>