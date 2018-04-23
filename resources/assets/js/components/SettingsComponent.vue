<template>
	<div>
		<el-tabs type="border-card">
			<el-tab-pane label="Акаунт">

				<el-form ref="form" :model="form" label-width="120px">
					<el-form-item label="Име">
						<el-input v-model="form.name"></el-input>
					</el-form-item>

					<el-form-item label="Бизнес акаунт">
						<el-switch v-model="form.type"></el-switch>
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
	import { EventBus } from '../app';
    export default {

    	data: function () {
    		return {
    			form: {
    				name: '',
    				type: ''
    			},
    		}
    	},

    	methods: {
    		
    	},

        mounted() {
            console.log('Settings mounted.')
        },

        created() {
            var vm = this;
        	axios.get('/data/venuelist').then(function (response) {
        		vm.venues = response.data;
        		console.log('event list');
				console.log(vm.events);
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    }
</script>