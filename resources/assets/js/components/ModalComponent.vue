<template>
	<!-- <div class="modal">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<div class="modal-header">
					<h5 class="modal-title">
						<slot name="header"></slot>
					</h5>
					<button type="button" class="close" @click="closeModal">
						<span aria-hidden="true">&times;</span>
					</button>
				</div>

				<div class="modal-body">
					<slot name="body"></slot>
				</div>

				<div class="modal-footer">
					<slot name="footer"></slot>
				</div>
			</div>
		</div>
	</div> -->
</template>

<script>
	import { EventBus } from '../app';
	export default {
    	data: function () {
    		return {
    			
    		}
    	},

    	methods: {
    		closeModal() {
    			EventBus.$emit('closeModal');
    		}
    	},

    	mounted() {
            console.log('Modal Component mounted.')
        }
    };
</script>

<style>
	.modal-mask {
		position: fixed;
		z-index: 9998;
		top: 0;
		left: 0;
		width: 100%;
		height: 100%;
		background-color: rgba(0, 0, 0, .5);
		display: table;
		transition: opacity .3s ease;
	}
</style>