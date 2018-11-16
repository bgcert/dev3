	<template>
		<div class="nav-item">
			<button type="button" class="btn btn-primary" @click.prevent="openModal">
				Вход
			</button>

			<!-- Try emit showModal -->
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
				showModal: false,
				dialogFormVisible: false,
				loading: false,
				form: {
					email: '',
					password: '',
					checked: true
				},
				errorMessage: ''
			}
		},
		mounted() {
			console.log('Login Component mounted.')
		},
		methods: {
			openModal() {
				this.showModal = true;
			},

			onSubmit() {
				this.loading = true;
				let vm = this;
				axios.post('/login', {
					email: vm.form.email,
					password: vm.form.password
				})
				.then(function (response) {
					console.log(response.data);
					vm.dialogFormVisible = false;
					window.location.reload();
				})
				.catch(function (error) {
					vm.loading = false;
					vm.errorMessage = error.response.data.errors;
				});
				console.log('submit!');
			},
			callRegister() {
				this.dialogFormVisible = false;
				setTimeout( function(){
					EventBus.$emit('registerClicked');
				}, 300 );
			},

			callReset() {
				window.location.href = '/password/reset';
			}
		},
		created() {
			EventBus.$on('loginClicked', () => {
				this.dialogFormVisible = true;
			});
		}
	};
	</script>