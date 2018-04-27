<template>
	<div>

		<el-tabs type="border-card">

			<el-tab-pane label="Акаунт">
				<el-form ref="form" :model="form" label-width="180px">
					<el-form-item label="Име">
						<el-input v-model="form.user.name"></el-input>
					</el-form-item>

					<el-form-item>
						<el-button type="primary" plain @click.prevent="setName"> Промени</el-button>
					</el-form-item>

					<el-form-item label="Бизнес акаунт">
						<el-switch v-model="form.publisher"></el-switch>
					</el-form-item>

					<template v-if="form.publisher">
						<el-form-item label="Име на организацията">
							<el-input v-model="form.company.name"></el-input>
						</el-form-item>

						<el-form-item label="Адрес">
							<el-input size="medium" placeholder="Въведете адрес" v-model="form.company.slug">
								<template slot="prepend">http://seminari365.com/</template>
							</el-input>
						</el-form-item>

						<el-form-item label="Публикуване на събития">
							<el-switch v-model="form.company.event_publish"></el-switch>
						</el-form-item>

						<el-form-item label="Публикуване на зали">
							<el-switch v-model="form.company.venue_publish"></el-switch>
						</el-form-item>
					</template>

					<el-form-item>
						<el-button type="primary" plain @click.prevent="setPublisher"> Промени</el-button>
					</el-form-item>
					
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

				<el-form ref="form" :model="form" label-width="180px">
					<el-form-item label="Нов email">
						<el-input v-model="form.user.email"></el-input>
					</el-form-item>
				</el-form>

				<el-form ref="form" :model="form" label-width="180px">
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
    			form: {
    				publisher: false,
	    			user: {
	    			},
	    			company: {
	    				name: '',
	    				slug: '',
	    				event_publish: false,
	    				venue_publish: false
	    			},
	    			oldPassword: '',
					newPassword: '',
					confirmNewPassword: '',
					email: '',
					password: ''
    			}
    		}
    	},

    	methods: {
    		setName() {
    			var vm = this;
    			var route = '/users/set/user/name';
    			axios.post(route, { id: vm.id, name: vm.user.name })
				.then(function (response) {
					console.log(response);
					vm.$message('Името е променено.');
				})
				.catch(function (error) {
					console.log(error);
				});
    		},

    		setPublisher() {
    			var vm = this;
    			var route = '/users/set/publisher/data';
    			axios.post(route,
    				{
    					id: vm.id,
    					publisher: vm.form.publisher,
    					name: vm.company.name,
    					slug: vm.company.slug,
    					event_publish: vm.company.event_publish,
    					venue_publish: vm.company.venue_publish
    				})
				.then(function (response) {
					console.log(response);
					vm.$message('Името е променено.');
				})
				.catch(function (error) {
					console.log(error);
				});
    			console.log(this.company);
    		}
    	},

        mounted() {
            console.log('Settings mounted.')
        },

        created() {
            var vm = this;
            var route = '/users/load/user/' + this.id;
        	axios.get(route).then(function (response) {
        		vm.form.user = response.data;
        		if (response.data.company) {
        			vm.form.company = response.data.company;
        		}
        		vm.form.publisher = (response.data.role_id == 2) ? true : false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    }
</script>