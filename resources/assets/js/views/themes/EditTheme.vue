<template>
	<div>
		<div class="ui segments">
			<div class="ui segment">
				<h4>Редактиране на тема</h4>
			</div>
			
			<div class="ui segment" v-if="!loading">
				<el-form ref="form" label-width="120px">
					<el-form-item label="Заглавие">
						<el-input v-model="theme.title"></el-input>
					</el-form-item>

					<el-form-item label="Категория">
						<el-select v-model="theme.category_id" placeholder="Изберете категория">
							<template v-for="category in categories">
								<el-option :label="category.name" :value="category.id"></el-option>	
							</template>
						</el-select>
					</el-form-item>
					
					<el-form-item label="Съдържание">
						<el-input type="textarea" :rows="12" v-model="theme.body"></el-input>
					</el-form-item>

					<el-form-item label="Корица">
							<ImageUpload
								:img="theme.cover">
							</ImageUpload>
					</el-form-item>

					<el-form-item>
						<div class="right floated">
							<div class="ui right floated primary button" @click="save">
					        	Запиши
					        </div>
							<router-link to="/themes" class="item">
								<div class="ui right floated basic button">
						        	Откажи
						        </div>
							</router-link>	
						</div>
					</el-form-item>
				</el-form>

			</div>
		</div>
	</div>
</template>
<script>
	import { EventBus } from '../../app'
	import ImageUpload from '../../components/ImageUploadComponent.vue'
    export default {
    	components: {
			ImageUpload
		},
    	data: function () {
    		return {
    			show: false,
    			loading: true,
    			selectedFile: null,
    			categories: [],
    			theme: [],
    		}
    	},

    	methods: {
    		save() {
    			let vm = this;
    			let image;

    			let formData = new FormData();
    			// Needed for patch request with form data
    			formData.append('_method', 'patch');
				formData.append('title', this.theme.title);
				formData.append('body', this.theme.body);
				formData.append('category_id', this.theme.category_id);

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

					let route = '/dashboard/themes/' + this.$route.params.id;
					axios.post(route, formData)
	    			.then(function (response) {
	    				console.log(response);
	    				vm.$message('Темата е редактирана успешно.');
	    				vm.$router.push('/themes');
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
            console.log('Edit theme view mounted.');
        },

        created() {

        	var vm = this;
            var route = '/dashboard/themes/' + this.$route.params.id + '/edit';
        	axios.get(route).then(function (response) {
        		vm.theme = response.data[0];
        		vm.categories = response.data[1];
        		vm.loading = false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>

<style>
	
</style>

