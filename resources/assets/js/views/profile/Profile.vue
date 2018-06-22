<template>
	<div class="ui segment" v-if="company.id">
		<form class="ui form">
			<div class="field">
				<label>Име на организацията</label>
				<input type="text" v-model="company.name">
			</div>

			<div class="field">
				<label>Адрес (URL) на профила в Seminari365</label>
				<div class="ui labeled right input">
					<div class="ui label">
						http://seminari365.com/
					</div>
					<input type="text" v-model="company.slug" placeholder="company.ltd">
				</div>
			</div>

			<div class="field">
				<label>Описание</label>
				<textarea v-model="company_detail.description"></textarea>
			</div>

			<div class="field">
				<label>E-mail</label>
				<input type="text" v-model="company_detail.email">
			</div>

			<div class="field">
				<label>Телефон</label>
				<input type="text" v-model="company_detail.phone">
			</div>

			<div class="field">
				<label>Адрес</label>
				<textarea rows="2" v-model="company_detail.address"></textarea>
			</div>

			<div class="field">
				<label>Facebook</label>
				<div class="ui labeled right input">
					<div class="ui label">
						http://facebook.com/
					</div>
					<input type="text" v-model="company_detail.facebook">
				</div>
			</div>

			<div class="field">
				<label>Instagram</label>
				<div class="ui labeled right input">
					<div class="ui label">
						http://instagram.com/
					</div>
					<input type="text" v-model="company_detail.instagram">
				</div>
			</div>

			<div class="field">
				<label>LinkedIn</label>
				<div class="ui labeled right input">
					<div class="ui label">
						http://linkedin.com/company/
					</div>
					<input type="text" v-model="company_detail.linkedin">
				</div>
			</div>
			
			<div class="field">
				<div class="ui basic clearing segment">
					<button class="ui labeled icon button" @click.prevent="save" style="float: right;"><i class="icon save"></i> Запиши</button>	
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
    			company: {},
    			company_detail: {}
    		}
    	},

    	methods: {
    		save() {
    			var vm = this;
    			var route = '/dashboard/save/company/data';
    			axios.post(route,
    				{
    					company_detail: vm.company_detail,
    					company: vm.company
    				})
				.then(function (response) {
					console.log(response);
					vm.$message('Данните са записани.');
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
        		console.log(response.data);
        		let data = response.data;
        		vm.company_detail = data.company_detail;
        		delete data.is_followed;
        		delete data.followers;
        		delete data.company_detail;
        		vm.company = response.data;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>