	<template>
		<div class="nav-item">
			<modal v-if="showModal">
				<h3 slot="header">
					Вход
				</h3>
				<div slot="body">
					<login></login>
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
			console.log('Login Component mounted.')
		},

		methods: {

		},

		created() {
			EventBus.$on('loginClicked', () => {
				this.showModal = true;
			});

			EventBus.$on('closeModal', () => {
				this.showModal = false;
			});
		}
	};
	</script>