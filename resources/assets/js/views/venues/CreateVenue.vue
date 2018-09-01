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
						<image-upload
							:index="1"
							:key="1"
							:imageUrl="'/img/default_cover.png'"
							:route="'/dashboard/venue/cover/upload'">
						</image-upload>
						<!-- <ImageUpload :img="'/img/default_cover.png'"></ImageUpload> -->
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
						<image-upload
							v-for="image in extraImages"
							:key="image + 1"
							:index="image + 1"
							:imageUrl="'/img/default_cover.png'"
							:route="'/dashboard/venue/image/upload'">
						</image-upload>
						<button class="ui basic button" @click.prevent="add">Добави изображение</button>
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
    		add() {
    			if (this.extraImages <= 11) {
    				this.extraImages++;
    			}
    		},

    		upload() {
    			let promise = new Promise((resolve, reject) => EventBus.$emit('upload', resolve, reject));
    			return promise;
    		},

    		uploadCover() {
    			let promise = new Promise((resolve, reject) => EventBus.$emit('upload', resolve, reject));
    			return promise;
    		},

    		uploadImages() {
    			let promise = new Promise((resolve, reject) => EventBus.$emit('upload', resolve, reject));
    			return promise;
    		},

    		async save() {
    			let vm = this;
				let data = {
					name: this.name,
					description: this.description,
					city_id: this.cityId,
					address: this.address,
					capacity: this.capacity,
					price: this.price,
					capacity: this.capacity
				}

				let cover = await this.upload();

				let image;
				let images = [];
				for (var i = 1; i <= this.extraImages; i++) {
					image = await this.upload();
					images.push(image);

				}

    			if (images.length > 0) {
    				data.images = images;
    			}

    			axios.post('/dashboard/venues', data)
    			.then(function (response) {
    				console.log('kjhkj');
    				vm.$message('Залата е добавена успешно.');
    				// vm.$router.push('/venues');
    			})
    			.catch(function (error) {
    				console.log(error);
    			})
    		},

    		destroyed() {
				EventBus.$off('upload');
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