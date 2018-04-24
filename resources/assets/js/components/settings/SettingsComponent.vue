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
						<el-switch v-model="form.type" @change="toggleType"></el-switch>
					</el-form-item>

					<el-form-item label="Публикуване на събития">
						<el-switch v-model="form.events" :disabled="!form.type"></el-switch>
					</el-form-item>

					<el-form-item label="Публикуване на зали">
						<el-switch v-model="form.venues" :disabled="!form.type"></el-switch>
					</el-form-item>
				</el-form>				
			</el-tab-pane>

			<el-tab-pane label="Промяна на парола">
				<el-form ref="form" :model="form" label-width="180px">
					<el-form-item label="Стара парола">
						<el-input v-model="form.name"></el-input>
					</el-form-item>
				</el-form>

				<el-form ref="form" :model="form" label-width="180px">
					<el-form-item label="Нова парола">
						<el-input v-model="form.name"></el-input>
					</el-form-item>
				</el-form>

				<el-form ref="form" :model="form" label-width="180px">
					<el-form-item label="Нова парола (отново)">
						<el-input v-model="form.name"></el-input>
					</el-form-item>
				</el-form>
			</el-tab-pane>

			<el-tab-pane label="Промяна на email">

				<el-form ref="form" :model="form" label-width="120px">
					<el-form-item label="Нов email">
						<el-input v-model="form.name"></el-input>
					</el-form-item>
				</el-form>

				<el-form ref="form" :model="form" label-width="120px">
					<el-form-item label="Парола">
						<el-input v-model="form.name"></el-input>
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
    			type: '',
    			form: {
    				name: '',
    				type: ''
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
    			axios.post(route, { id: vm.id, type: vm.form.type })
				.then(function (response) {
					console.log(response);
					vm.$message('Името е променено.');
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
        		vm.form.type = (response.data.role_id == 2) ? true : false;
        		vm.form.name = response.data.name;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    }
</script>