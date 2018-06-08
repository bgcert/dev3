<template>
	<div>
		<div class="ui segments">
			<div class="ui segment">
				<h4>Нова тема</h4>
			</div>
			
			<div class="ui segment">
				<el-form ref="form" :model="form" label-width="120px">
					<el-form-item label="Заглавие">
						<el-input v-model="form.title"></el-input>
					</el-form-item>

					<el-form-item label="Категория">
						<el-select v-model="form.category" placeholder="Изберете категория">
							<template v-for="category in categories">
								<el-option :label="category.name" :value="category.id"></el-option>	
							</template>
						</el-select>
					</el-form-item>

					<el-form-item label="Корица">
						<imageUpload
							canvasWidth="357"
							canvasHeight="178"
							>
						</imageUpload>
					</el-form-item>
					
					<el-form-item label="Съдържание">
						<el-input type="textarea" :rows="12" v-model="form.body"></el-input>
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
	import { EventBus } from '../../app';
    export default {
    	data: function () {
    		return {
    			loading: true,
    			categories: [],
    			form: {
    				title: '',
    				category: '',
    				body: '',
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
				formData.append('title', this.form.title);
				formData.append('body', this.form.body);
				formData.append('category_id', this.form.category);

    			let config =
					{
						header : {
							'Content-Type' : 'multipart/form-data'
						}
					}

    			let upload = new Promise((resolve, reject) => EventBus.$emit('imageSave', resolve, reject));

				upload.then((data) => {
					formData.append('cover', data[0]);
					formData.append('width', data[1]);
					formData.append('position', data[2]);

					axios.post('/dashboard/themes', formData, config)
	    			.then(function (response) {
	    				console.log(response);
	    				vm.$message('Темата е добавена успешно.');
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
            console.log('New theme view mounted.')
        },

        created() {
        	var vm = this;
            var route = '/dashboard/categories';
        	axios.get(route).then(function (response) {
        		console.log(response.data);
        		vm.categories = response.data;
        		vm.loading = false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>