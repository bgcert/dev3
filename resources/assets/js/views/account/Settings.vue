<template>
	<div class="form col-lg-4 col-sm-12">
		<div class="form-group">
			<label>Име</label>
			<input type="text" class="form-control" v-model="form.user.firstname">
		</div>

		<div class="form-group">
			<label>Фамилия</label>
			<input type="text" class="form-control" v-model="form.user.lastname">
		</div>

		<div class="form-group">
			<button class="btn btn-primary" @click.prevent="setName"> Запиши промените</button>
		</div>

		<hr>

		<div class="form-group">
			<div class="form-check">
				<input type="checkbox" class="form-check-input" id="business-account" v-model="form.publisher">
				<label class="form-check-label" for="business-account">Бизнес акаунт</label>
			</div>
		</div>

		<template v-if="form.publisher">
			<template v-if="errors.name" v-for="error in errors.name">
				 <el-alert type="error" :title="error"></el-alert>
			</template>
			<div class="form-group">
				<label>Име на организацията</label>
				<input type="text" class="form-control" v-model="form.user.company.name">
			</div>

			<div class="form-group">
				<label>Адрес на профила</label>
				<template v-if="errors.slug" v-for="error in errors.slug">
					 <el-alert type="error" :title="error"></el-alert>
				</template>
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">seminari365.com/c/</div>
					</div>
					<input type="text" class="form-control" v-model="form.user.company.slug" placeholder="company.ltd">
				</div>
				<small class="form-text text-muted">Пример: abcltd или abc.ltd</small>
			</div>

			<div class="form-group">
				<a href="#">http://seminari365.com/c/{{ form.user.company.slug }}</a>
			</div>

			<div class="form-group">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="event-publish" v-model="form.user.company.event_publish">
					<label class="form-check-label" for="event-publish">
						Публикуване на събития
					</label>
				</div>

				<div class="form-check">
					<input class="form-check-input" type="checkbox" id="venue-publish" v-model="form.user.company.venue_publish">
					<label class="form-check-label" for="venue-publish">
						Публикуване на зали
					</label>
				</div>
			</div>

			<div class="form-group">
				<button class="btn btn-primary" @click.prevent="setPublisher"> Запиши промените</button>
			</div>
		</template>

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