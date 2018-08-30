<template>
	<div>
		<div class="ui segments" v-if="cities != null">
			<div class="ui segment">
				<h4>Нова зала</h4>
			</div>
			
			<div class="ui segment">
				<el-form label-width="160px">
					<el-form-item label="Наименование">
						<el-input v-model="name"></el-input>
					</el-form-item>

					<el-form-item label="Основна снимка">
						<ImageUpload :img="'/img/default_cover.png'"></ImageUpload>
					</el-form-item>

					<el-form-item label="Капацитет">
						<el-input v-model="capacity" style="width: 160px;">
							<template slot="append">места</template>
						</el-input>
					</el-form-item>

					<el-form-item label="Град">
						<el-select v-model="cityId" placeholder="Изберете град">
							<el-option
								v-for="city in cities"
								:key="city.id"
								:label="city.name"
								:value="city.id">
							</el-option>
						</el-select>
					</el-form-item>

					<el-form-item label="Адрес">
						<el-input v-model="address"></el-input>
					</el-form-item>
					
					<el-form-item label="Описание">
						<el-input type="textarea" :rows="12" v-model="description"></el-input>
					</el-form-item>

					<el-form-item label="Цена">
						<el-input v-model="price" style="width: 200px;">
							<template slot="append">.00 лв. с ДДС</template>
						</el-input>
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
	import ImageUpload from '../../components/ImageUploadComponent.vue'
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
				cities: null,
				cityId: null,
				address: '',
				capacity: null,
				price: null,
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

    			let formData = new FormData();
				formData.append('name', this.name);
				formData.append('description', this.description);
				formData.append('city_id', this.cityId);
				formData.append('address', this.address);
				formData.append('capacity', this.capacity);
				formData.append('price', this.price);
				formData.append('capacity', this.capacity);

				let config =
					{
						header : {
							'Content-Type' : 'multipart/form-data'
						}
					}

    			let cover = await this.uploadCover();
    			this.imageList = await this.uploadImages();

    			if (cover) {
    				formData.append('cover', cover);
    			}

    			if (this.imageList.length > 0) {
    				// console.log(this.imageList);
    				formData.append('images', this.imageList);
    			}

    			axios.post('/dashboard/venues', formData, config)
    			.then(function (response) {
    				vm.$message('Залата е добавена успешно.');
    				vm.$router.push('/venues');
    			})
    			.catch(function (error) {
    				console.log(error);
    			})
    		}
    	},

        mounted() {
            console.log('New venue view mounted.');

            let vm = this;
            axios.get('/api/cities')
            .then(function (response) {
            	vm.cities = response.data;
			})
			.catch(function (error) {
			    console.log(error);
			});
        },

        created() {

        }
    };
</script>