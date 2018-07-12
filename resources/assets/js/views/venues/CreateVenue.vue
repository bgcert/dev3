<template>
	<div>
		<div class="ui segments">
			<div class="ui segment">
				<h4>Нова зала</h4>
			</div>
			
			<div class="ui segment">
				<el-form label-width="120px">
					<el-form-item label="Наименование">
						<el-input v-model="name"></el-input>
					</el-form-item>

					<el-form-item label="Корица">
							<ImageUpload>
							</ImageUpload>
					</el-form-item>

					<el-form-item label="Капацитет">
						<el-input v-model="capacity"></el-input>
					</el-form-item>
					
					<el-form-item label="Описание">
						<el-input type="textarea" :rows="12" v-model="description"></el-input>
					</el-form-item>

					<el-form-item label="Цена">
						<el-input v-model="price"></el-input>
					</el-form-item>

					<el-form-item>
						<div class="right floated">
							<div class="ui right floated primary button" @click="save">
					        	Запиши
					        </div>
							<router-link to="/venues" class="item">
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
				name: '',
				description: '',
				capacity: null,
				price: null,
				cover: 'https://picsum.photos/800/400/?image=293'
    		}
    	},

    	methods: {
    		save() {
    			let vm = this;
    			let image;

    			let formData = new FormData();
				formData.append('name', this.name);
				formData.append('body', this.description);
				formData.append('capacity', this.capacity);

    			let config =
					{
						header : {
							'Content-Type' : 'multipart/form-data'
						}
					}

    			let upload = new Promise((resolve, reject) => EventBus.$emit('imageSave', resolve, reject));

				upload.then((data) => {
					if (data) {
						formData.append('file', data);	
					}
					
					axios.post('/dashboard/venues', formData, config)
	    			.then(function (response) {
	    				console.log(response);
	    				vm.$message('Залата е добавена успешно.');
	    				vm.$router.push('/venues');
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
            console.log('New venue view mounted.')
        },

        created() {

        }
    };
</script>