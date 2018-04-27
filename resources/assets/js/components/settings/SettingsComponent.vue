<template>
	<div>

		<el-tabs type="border-card">

			<el-tab-pane label="Акаунт">
				<el-form ref="form" :model="form" label-width="180px">
					<el-form-item label="Име">
						<el-input v-model="form.name"></el-input>
					</el-form-item>

					<el-form-item>
						<el-button type="primary" plain @click.prevent="setName"> Промени</el-button>
					</el-form-item>

					<el-form-item label="Бизнес акаунт">
						<el-switch v-model="form.publisher" @change="toggleType"></el-switch>
					</el-form-item>

					<template v-if="form.publisher">
						<el-form-item label="Публикуване на събития">
							<el-switch v-model="form.events" @change="toggleEventPublish"></el-switch>
						</el-form-item>

						<el-form-item label="Публикуване на зали">
							<el-switch v-model="form.venues" @change="toggleVenuePublish"></el-switch>
						</el-form-item>	
					</template>
					
				</el-form>				
			</el-tab-pane>

			<el-tab-pane label="Промяна на парола">
				<el-form ref="form" :model="form" label-width="180px">
					<el-form-item label="Стара парола">
						<el-input type="password" v-model="form.oldPassword"></el-input>
					</el-form-item>
				</el-form>

				<el-form ref="form" :model="form" label-width="180px">
					<el-form-item label="Нова парола">
						<el-input type="password" v-model="form.newPassword"></el-input>
					</el-form-item>
				</el-form>

				<el-form ref="form" :model="form" label-width="180px">
					<el-form-item label="Нова парола (отново)">
						<el-input type="password" v-model="form.confirmNewPassword"></el-input>
					</el-form-item>
				</el-form>
			</el-tab-pane>

			<el-tab-pane label="Промяна на email">

				<el-form ref="form" :model="form" label-width="120px">
					<el-form-item label="Нов email">
						<el-input v-model="form.email"></el-input>
					</el-form-item>
				</el-form>

				<el-form ref="form" :model="form" label-width="120px">
					<el-form-item label="Парола">
						<el-input type="password" v-model="form.password"></el-input>
					</el-form-item>
				</el-form>

			</el-tab-pane>
			<el-tab-pane label="Деактивиране">
				<el-button type="danger">Деактивирай</el-button>
			</el-tab-pane>
		</el-tabs>
	</div>
</template>

<script>
	import { EventBus } from '../../app';
    export default {
		props: ['id'],

    	data: function () {
    		return {
    			user: [],
    			form: {
    				name: '',
    				publisher: '',
    				events: '',
    				venues: '',
    				oldPassword: '',
    				newPassword: '',
    				confirmNewPassword: '',
    				email: '',
    				password: ''
    			},
    		}
    	},

    	methods: {
    		setName() {
    			var vm = this;
    			var route = '/users/set/user/name';
    			axios.post(route, { id: vm.id, name: vm.form.name })
				.then(function (response) {
					console.log(response);
					vm.$message('Името е променено.');
				})
				.catch(function (error) {
					console.log(error);
				});
    		},

    		toggleType() {
    			var vm = this;
    			var route = '/users/set/account/type';
    			axios.post(route, { id: vm.id, publisher: vm.form.publisher })
				.then(function (response) {
					console.log(response);
					vm.$message('Видът на акаунта е променен.');
				})
				.catch(function (error) {
					console.log(error);
				});
    		},

    		toggleEventPublish() {
    			var vm = this;
    			var route = '/users/set/publish/event';
    			axios.post(route, { id: vm.id, status: vm.form.events })
				.then(function (response) {
					console.log(response);
					var status = (vm.form.events) ? 'активирано' : 'деактивирано';
					vm.$message(`Публикуването на събития е ${status}.`);
				})
				.catch(function (error) {
					console.log(error);
				});
    		},

    		toggleVenuePublish() {
    			var vm = this;
    			var route = '/users/set/publish/venue';
    			axios.post(route, { id: vm.id, status: vm.form.venues })
				.then(function (response) {
					console.log(response);
					var status = (vm.form.venues) ? 'активирано' : 'деактивирано';
					vm.$message(`Публикуването на зали е ${status}.`);
				})
				.catch(function (error) {
					console.log(error);
				});
    		}
    	},

        mounted() {
            console.log('Settings mounted.')
        },

        created() {
            var vm = this;
            var route = '/users/load/user/' + this.id;
        	axios.get(route).then(function (response) {
        		vm.user = response.data;
        		vm.form.publisher = (response.data.role_id == 2) ? true : false;
        		vm.form.name = response.data.name;
        		vm.form.events = Boolean(response.data.company.event_publish);
        		vm.form.venues = Boolean(response.data.company.venue_publish);
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    }
</script>