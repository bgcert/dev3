<template>
	<div>
		<div class="ui segments">
			<div class="ui segment">
				<h4>Нов лектор</h4>
			</div>
			
			<div class="ui segment">
				<el-form ref="form" :model="form" label-width="120px">
					<el-form-item label="Име">
						<el-input v-model="form.name"></el-input>
					</el-form-item>

					<el-form-item label="Снимка">
						<ImageUpload
							:canvasWidth="200"
							:canvasHeight="200"
							>
						</ImageUpload>
					</el-form-item>

					<el-form-item label="Съдържание">
						<el-input type="textarea" :rows="12" v-model="form.details"></el-input>
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
    			form: {
    				name: '',
    				details: '',
    				region: '',
    				date1: '',
    				date2: '',
    				delivery: false,
    				type: [],
    				resource: '',
    				cover: 'https://picsum.photos/800/400/?image=293'
    			}
    		}
    	},

    	methods: {
    		save() {
    			let vm = this;
    			let image;

    			let formData = new FormData();
    			// Needed for patch request with form data
    			formData.append('_method', 'patch');
    			formData.append('name', this.form.name);
				formData.append('details', this.form.details);

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

					axios.post('/dashboard/teachers/', formData, config)
		    			.then(function (response) {
		    				vm.$message('Лекторът е добавен.');
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
            console.log('Create teacher view mounted.')
        },

        created() {

        }
    };
</script>