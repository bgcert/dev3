<template>
	<div class="ui segment" v-if="company.id">
		<form class="ui form">
			<div class="field">
				<label>Име на организацията</label>
				<input type="text" v-model="company.name">
			</div>

			<div class="field">
				<label>Адрес</label>
				<textarea rows="2"></textarea>
			</div>

			<div class="field">
				<label>Описание</label>
				<textarea></textarea>
			</div>

			<div class="field">
				<label>Адрес на профила в Seminari365</label>
				<div class="ui labeled right input">
					<div class="ui label">
						http://seminari365.com/
					</div>
					<input type="text" v-model="company.slug" placeholder="company.ltd">
				</div>
			</div>

			<div class="field">
				<label>Facebook</label>
				<div class="ui labeled right input">
					<div class="ui label">
						http://facebook.com/
					</div>
					<input type="text" v-model="company.company_detail.facebook">
				</div>
			</div>

			<div class="field">
				<label>Instagram</label>
				<div class="ui labeled right input">
					<div class="ui label">
						http://instagram.com/
					</div>
					<input type="text" v-model="company.company_detail.instagram">
				</div>
			</div>

			<div class="field">
				<label>LinkedIn</label>
				<div class="ui labeled right input">
					<div class="ui label">
						http://linkedin.com/company/
					</div>
					<input type="text" v-model="company.company_detail.linkedin">
				</div>
			</div>
			
			<div class="field">
				<div class="ui basic clearing segment">
					<button class="ui labeled icon button" @click.prevent="" style="float: right;"><i class="icon save"></i> Запиши</button>	
				</div>
			</div>
			
		</form>

	</div>
</template>

<script>
	import { EventBus } from '../../app';
    export default {
    	data: function () {
    		return {
    			company: {}
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
            var route = '/dashboard/load/company';
        	axios.get(route).then(function (response) {
        		console.log('test');
        		console.log(response.data);
        		vm.company = response.data;
        		// vm.form.user = response.data;
        		// if (response.data.company) {
        		// 	vm.form.user.company = response.data.company;
        		// } else {
        		// 	vm.form.user.company = vm.company;
        		// }
        		// vm.form.publisher = (response.data.role_id == 2) ? true : false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    }
</script>