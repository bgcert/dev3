<template>
	<div v-if="showModal">
		<div class="modal fade" id="loginModal" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
			<div class="modal-dialog" role="document">
				<div class="modal-content">
					<div class="modal-header">
						<h5 class="modal-title">Вход</h5>
						<button type="button" class="close" aria-label="Close" @click.prevent="closeModal">
							<span aria-hidden="true">&times;</span>
						</button>
					</div>
					<div class="modal-body">
						<login></login>
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
		console.log('Login Modal Component mounted.')
	},

	methods: {
		openModal() {
			this.showModal = true;
			Vue.nextTick(function () {
			  $('#loginModal').modal('show');
			})
		},

		closeModal() {
			$('#loginModal').modal('hide').promise().done(function(){
			    this.showModal = false;
			});
		}
	},

	created() {
		EventBus.$on('loginClicked', () => {
			this.openModal();
		});
	}
};
</script>