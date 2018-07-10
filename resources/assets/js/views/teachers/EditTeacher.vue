<template>
	<div>
		<div class="ui segments">
			<div class="ui secondary segment">
				<h4>Редактиране на лектор</h4>
			</div>
			
			<div class="ui segment" v-if="!loading">
				<el-form ref="form" label-width="120px">
					<el-form-item label="Име">
						<el-input v-model="teacher.name"></el-input>
					</el-form-item>

					<el-form-item label="Снимка">
						<ImageUpload
							:img="teacher.image"
							>
						</ImageUpload>
					</el-form-item>

					<el-form-item label="Съдържание">
						<el-input type="textarea" :rows="12" v-model="teacher.details"></el-input>
					</el-form-item>
					<el-form-item>
						<div class="right floated">
							<div class="ui right floated primary button" @click="save">
					        	Запиши
					        </div>
							<router-link to="/teachers" class="item">
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
	import { EventBus } from '../../app';
	import ImageUpload from '../../components/ImageUploadComponent.vue'
    export default {
		components: {
			ImageUpload
		},
    	data: function () {
    		return {
    			loading: true,
    			teacher: [],
    		}
    	},

    	methods: {
    		save() {
    			let vm = this;
    			let image;

    			let formData = new FormData();
    			// Needed for patch request with form data
    			formData.append('_method', 'patch');
    			formData.append('name', this.teacher.name);
				formData.append('details', this.teacher.details);

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

					let route = '/dashboard/teachers/' + this.$route.params.id;
					axios.post(route, formData, config)
		    			.then(function (response) {
		    				console.log(response);
		    				vm.$message('Данните са редактирани успешно.');
		    				vm.$router.push('/teachers');
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
            console.log('Edit teacher view mounted.')
        },

        created() {
        	var vm = this;
            var route = '/dashboard/teachers/' +  this.$route.params.id + '/edit';
        	axios.get(route).then(function (response) {
        		console.log(response.data);
        		vm.teacher = response.data;
        		//vm.categories = response.data[1];
        		vm.loading = false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    }
</script>