<template>
	<div>
		<form class="ui form">
			<div class="field">
				<label>Име</label>
				<input type="text" v-model="form.user.name">
			</div>
			<div class="field">
				<button class="ui basic button" @click.prevent="setName"> Промени</button>
			</div>
			<div class="ui section divider"></div>
			<div class="field">
				<div class="ui toggle checkbox">
					<input type="checkbox" v-model="form.publisher">
					<label> Бизнес акаунт</label>
				</div>
			</div>
			<template v-if="form.publisher">
				<div class="field">
					<label>Име на организацията</label>
					<input type="text" v-model="form.user.company.name">
				</div>
				<div class="field">
					<label>Адрес на профила</label>
					<div class="ui labeled right input">
						<div class="ui label">
							http://seminari365.com/
						</div>
						<input type="text" v-model="form.user.company.slug" placeholder="company.ltd">
					</div>
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
				<button class="ui basic button" @click.prevent="setPublisher"> Промени</button>
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
				}
    		}
    	},

    	methods: {
    		setName() {
    			var vm = this;
    			var route = '/users/set/user/name';
    			axios.post(route, { name: vm.form.user.name })
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
    					publisher: vm.form.publisher,
    					name: vm.form.user.company.name,
    					slug: vm.form.user.company.slug,
    					event_publish: vm.form.user.company.event_publish,
    					venue_publish: vm.form.user.company.venue_publish
    				})
				.then(function (response) {
					console.log(response);
					vm.$message('Данните са променени.');
				})
				.catch(function (error) {
					console.log(error);
				});
    			console.log(this.company);
    		},
    	},

        mounted() {
            console.log('Settings mounted.')
        },

        created() {
            var vm = this;
            var route = '/users/load/user/';
        	axios.get(route).then(function (response) {
        		console.log(response.data);
        		vm.form.user = response.data;
        		if (response.data.company) {
        			vm.form.user.company = response.data.company;
        		} else {
        			vm.form.user.company = vm.company;
        		}
        		vm.form.publisher = (response.data.role_id == 2) ? true : false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>