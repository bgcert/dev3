<template>
	<div class="ui clearing segment" v-if="company.id">
		<form class="ui form">
			<div class="field" style="width: 300px;">
				<label>Име на организацията</label>
				<input type="text" v-model="company.name">
			</div>

			<div class="field" style="width: 400px;">
				<label>Адрес (URL) на профила в Seminari365</label>
				<div class="ui labeled right input">
					<div class="ui label">
						http://seminari365.com/
					</div>
					<input type="text" v-model="company.slug" placeholder="company.ltd">
				</div>
			</div>

			<div class="field">
				<label>Лого</label>
				<ImageUpload :img="company.logo"></ImageUpload>
			</div>

			<div class="field">
				<label>Описание</label>
				<textarea rows="6" v-model="company.description"></textarea>
			</div>

			<div class="equal width fields">
				<div class="field">
				<label>E-mail</label>
				<input type="text" v-model="company.email">
			</div>

			<div class="field">
				<label>Телефон</label>
				<input type="text" v-model="company.phone">
			</div>
			</div>
			
			<div class="field">
				<label>Адрес</label>
				<textarea rows="2" v-model="company.address"></textarea>
			</div>
			
			<div class="field">
				<button class="ui labeled icon button" @click.prevent="save" style="float: right;"><i class="icon save"></i> Запиши</button>
			</div>
			
		</form>

	</div>
</template>

<script>
	import { EventBus } from '../../app';
	import ImageUpload from '../../components/ImageUploadComponent.vue'
    export default {
    	components: {
			ImageUpload
		},
    	data: function () {
    		return {
    			company: [],
    			company_details: []
    		}
    	},

    	methods: {
    		save() {
    			let vm = this;
    			let image;

    			let formData = new FormData();
    			// Needed for patch request with form data
    			// formData.append('_method', 'patch');
    			formData.append('name', this.company.name);
    			formData.append('slug', this.company.slug);
    			formData.append('address', this.address);
    			formData.append('description', this.description);
    			formData.append('email', this.email);
    			formData.append('phone', this.phone);

    			let config =
					{
						header : {
							'Content-Type' : 'multipart/form-data'
						}
					}

    			let upload = new Promise((resolve, reject) => EventBus.$emit('imageSave', resolve, reject));

				upload.then((data) => {
					// Append if file selected
					if (data) {
						formData.append('file', data);
					}

					axios.post('/dashboard/save/company/data', formData , config)
	    			.then(function (response) {
	    				vm.$message('Данните са запазени.');
	    			})
	    			.catch(function (error) {
	    				console.log(error);
	    			});
				}, (error) => {
					vm.$message('Невалидно изображение');
				});
    		}
    	},

        mounted() {
            console.log('Settings mounted.')
        },

        created() {
            var vm = this;
            var route = '/dashboard/load/company';
        	axios.get(route).then(function (response) {
        		vm.company = response.data;
        		// let data = response.data;
        		// vm.company_details = data.company_detail;
        		// delete data.is_followed;
        		// delete data.followers;
        		// vm.company = response.data;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>