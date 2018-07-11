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
				<label>Лого</label>
				<ImageUpload
					:img="company_details.logo">
				</ImageUpload>
			</div>

			<div class="field">
				<label>Описание</label>
				<textarea v-model="company_details.description"></textarea>
			</div>

			<div class="field">
				<label>E-mail</label>
				<input type="text" v-model="company_details.email">
			</div>

			<div class="field">
				<label>Телефон</label>
				<input type="text" v-model="company_details.phone">
			</div>

			<div class="field">
				<label>Адрес</label>
				<textarea rows="2" v-model="company_details.address"></textarea>
			</div>

			<div class="field">
				<label>Facebook</label>
				<div class="ui labeled right input">
					<div class="ui label">
						http://facebook.com/
					</div>
					<input type="text" v-model="company_details.facebook">
				</div>
			</div>

			<div class="field">
				<label>Instagram</label>
				<div class="ui labeled right input">
					<div class="ui label">
						http://instagram.com/
					</div>
					<input type="text" v-model="company_details.instagram">
				</div>
			</div>

			<div class="field">
				<label>LinkedIn</label>
				<div class="ui labeled right input">
					<div class="ui label">
						http://linkedin.com/company/
					</div>
					<input type="text" v-model="company_details.linkedin">
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
    			formData.append('address', this.company_details.address);
    			formData.append('description', this.company_details.description);
    			formData.append('phone', this.company_details.phone);
    			formData.append('facebook', this.company_details.facebook);
    			formData.append('instagram', this.company_details.instagram);
    			formData.append('linkedin', this.company_details.linkedin);
    			formData.append('youtube', this.company_details.youtube);

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
	    				console.log(response);
	    				vm.$message('Данните са записани.');
	    			})
	    			.catch(function (error) {
	    				console.log(error);
	    			});
				}, (error) => {
					console.log('Promise rejected.');
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
        		console.log(response.data);
        		let data = response.data;
        		vm.company_details = data.company_detail;
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