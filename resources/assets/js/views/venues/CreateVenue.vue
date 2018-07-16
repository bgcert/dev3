<template>
	<div>
		<div class="ui segments">
			<div class="ui segment">
				<h4>Нова зала</h4>
			</div>
			
			<div class="ui segment">
				<el-form label-width="160px">
					<el-form-item label="Наименование">
						<el-input v-model="name"></el-input>
					</el-form-item>

					<el-form-item label="Основна снимка">
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

					<el-form-item label="Допълнителни снимки">
						<UploadMany></UploadMany>
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
	import ImageUpload from '../../components/UploadComponent.vue'
	import UploadMany from '../../components/UploadManyComponent.vue'
    export default {
    	components: {
			ImageUpload, UploadMany
		},
    	data: function () {
    		return {
    			loading: true,
				name: '',
				description: '',
				capacity: null,
				price: null,
				cover: 'https://picsum.photos/800/400/?image=293',
				extraImages: 1,
				imageList: []
    		}
    	},

    	methods: {
    		uploadCover() {
    			let promise = new Promise((resolve, reject) => EventBus.$emit('imageSave', resolve, reject));
    			return promise;
    		},
    		uploadImages() {
    			let promise = new Promise((resolve, reject) => EventBus.$emit('imageSaveMany', resolve, reject));
    			return promise;
    		},
    		async save() {
    			let vm = this;

    			this.cover = await this.uploadCover();
    			this.imageList = await this.uploadImages();

    			console.log(this.imageList);

    			axios.post('/dashboard/venues', {
					name: vm.name,
					description: vm.description,
					capacity: vm.capacity,
					cover: vm.cover,
					images: vm.imageList

				})
    			.then(function (response) {
    				console.log(response);
    				vm.$message('Залата е добавена успешно.');
    				vm.$router.push('/venues');
    			})
    			.catch(function (error) {
    				console.log(error);
    			})
    		}
    	},

        mounted() {
            console.log('New venue view mounted.')
        },

        created() {

        }
    };
</script>