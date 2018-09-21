<template>
	<div>
		<form class="ui form">
			<div class="fields">
				<div class="field">
					<label>Име</label>
					<input type="text" v-model="form.user.firstname">
				</div>
				<div class="field">
					<label>Фамилия</label>
					<input type="text" v-model="form.user.lastname">
				</div>
			</div>
			<div class="field">
				<button class="ui basic button" @click.prevent="setName"> Запиши промените</button>
			</div>
			<div class="ui section divider"></div>
			<div class="field">
				<div class="ui toggle checkbox">
					<input type="checkbox" v-model="form.publisher">
					<label> Бизнес акаунт</label>
				</div>
			</div>
			<template v-if="form.publisher">
				<template v-if="errors.name" v-for="error in errors.name">
					 <el-alert type="error" :title="error"></el-alert>
				</template>
				<div class="field" style="width: 200px;">
					<label>Име на организацията</label>
					<input type="text" v-model="form.user.company.name">
				</div>
				<div class="field" style="width: 300px;">
					<label>Адрес на профила</label>
					<template v-if="errors.slug" v-for="error in errors.slug">
						 <el-alert type="error" :title="error"></el-alert>
					</template>
					<div class="ui labeled right input">
						<div class="ui label">
							http://seminari365.com/c/
						</div>
						<input type="text" v-model="form.user.company.slug" placeholder="company.ltd">
					</div>
					<div class="ui info message">Пример: abcltd или abc.ltd</div>
				</div>
				<div class="field">
					<div class="ui toggle checkbox">
						<input type="checkbox" v-model="form.user.company.event_publish">
						<label> Публикуване на събития</label>
					</div>
				</div>
				<div class="field">
					<div class="ui toggle checkbox">
						<input type="checkbox" v-model="form.user.company.venue_publish">
						<label> Публикуване на зали</label>
					</div>
				</div>
			</template>
			
			<div class="field">
				<button class="ui basic button" @click.prevent="setPublisher"> Запиши промените</button>
				<!-- <a v-if="showDashboard" class="ui orange button" href="/dashboard#/profile"> Бизнес панел</a> -->
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