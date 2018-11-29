<template>
	<div v-if="showModal">
		<div class="modal fade" id="registerModal" tabindex="-1" role="dialog" aria-labelledby="registerModal" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Регистрация</h5>
						<button type="button" class="close" aria-label="Close" @click.prevent="closeModal">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<register></register>
					</div>
				</div>
			</div>
		</div>
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

        methods: {
        	openModal() {
				this.showModal = true;
				Vue.nextTick(function () {
				  $('#registerModal').modal('show');
				})
			},

			closeModal() {
				$('#registerModal').modal('hide').promise().done(function(){
				    this.showModal = false;
				});
			}
        },

        created() {
        	EventBus.$on('registerClicked', () => {
				this.openModal();
			});
        }
    };
</script>

<style>

</style>