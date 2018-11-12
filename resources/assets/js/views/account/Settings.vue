<template>
	<div>
		<form class="form">
			<div class="field">
				<label>Име</label>
				<input type="text" v-model="form.user.firstname">
			</div>
			<div class="field">
				<label>Фамилия</label>
				<input type="text" v-model="form.user.lastname">
			</div>
			<div class="field">
				<button class="btn blue" @click.prevent="setName"> Запиши промените</button>
			</div>
			<hr>
			<div class="field">
				<input type="checkbox" v-model="form.publisher"> Бизнес акаунт
			</div>
			<template v-if="form.publisher">
				<template v-if="errors.name" v-for="error in errors.name">
					 <el-alert type="error" :title="error"></el-alert>
				</template>
				<div class="field">
					<label>Име на организацията</label>
					<input type="text" v-model="form.user.company.name">
				</div>

				<div class="field">
					<label>Адрес на профила</label>
					<template v-if="errors.slug" v-for="error in errors.slug">
						 <el-alert type="error" :title="error"></el-alert>
					</template>
					<span class="label input">
						http://seminari365.com/c/
					</span>
					<input  class="labeled" type="text" v-model="form.user.company.slug" placeholder="company.ltd">
					<span>Пример: abcltd или abc.ltd</span>
				</div>

				<div>
					<a href="#">http://seminari365.com/c/{{ form.user.company.slug }}</a>
				</div>

				<div class="field">
					<input type="checkbox" v-model="form.user.company.event_publish"> Публикуване на събития
				</div>

				<div class="field">
					<input type="checkbox" v-model="form.user.company.venue_publish"> Публикуване на зали
				</div>
			</template>
			
			<div class="field">
				<button class="btn blue" @click.prevent="setPublisher"> Запиши промените</button>
			</div>
			
		</form>

	</div>
</template>

<script>
	import { EventBus } from '../../app';
    export default {
    	data: function () {
    		return {
    			form: {
    				publisher: false,
	    			user: {},
	    			oldPassword: '',
					newPassword: '',
					confirmNewPassword: '',
					email: '',
					password: ''
    			},
    			company: {
    				name: '',
    				slug: '',
    				event_publish: false,
    				venue_publish: false
				},
				errors: [],
				showDashboard: false
    		}
    	},

    	methods: {
    		setName() {
    			var vm = this;
    			var route = '/users/set/user/name';
    			axios.post(route, { firstname: vm.form.user.firstname, lastname: vm.form.user.lastname })
				.then(function (response) {
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
    					publisher: vm.form.publisher,
    					name: vm.form.user.company.name,
    					slug: vm.form.user.company.slug,
    					event_publish: vm.form.user.company.event_publish,
    					venue_publish: vm.form.user.company.venue_publish
    				})
				.then(function (response) {
					vm.$message('Данните са променени.');
					setTimeout(function() {
						location.reload();
					}, 1500);
				})
				.catch(function (error) {
					vm.errors = error.response.data;
					// console.log(error);
				});
    		},
    	},

        mounted() {
            console.log('Settings mounted.')
        },

        created() {
            var vm = this;
            var route = '/users/load/user/';
        	axios.get(route).then(function (response) {
        		vm.form.user = response.data;
        		console.log(response.data);
        		if (response.data.company) {
        			vm.form.user.company = response.data.company;
        		} else {
        			vm.form.user.company = vm.company;
        		}

        		if (response.data.role_id == 2) {
        			vm.showDashboard = true;
        		} else {
        			vm.showDashboard = false;
        		}
        		

        		vm.form.publisher = (response.data.role_id == 2) ? true : false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>