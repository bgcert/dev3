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
						<imageUpload
							:imageUrl="'/img/default_cover.png'"
							:route="'/dashboard/venue/cover/upload'">
						</imageUpload>
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
						<multi-image-upload
							:imageUrl="'/img/default_cover.png'"
							:route="'/dashboard/venue/image/upload'">
						</multi-image-upload>
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
	import MultiImageUpload from '../../components/MultiImageUploadComponent.vue'
    export default {
    	components: {
			ImageUpload, MultiImageUpload
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
				imageList: [],
				data: {}
    		}
    	},

    	methods: {
    		upload() {
    			let promise = new Promise((resolve, reject) => EventBus.$emit('upload', resolve, reject));
    			return promise;
    		},

    		multiUpload() {
    			let promise = new Promise((resolve, reject) => EventBus.$emit('multi-upload', resolve, reject));
    			return promise;
    		},

    		async save() {
    			let vm = this;
				this.data = {
					name: this.name,
					description: this.description,
					city_id: this.cityId,
					address: this.address,
					capacity: this.capacity,
					price: this.price,
					capacity: this.capacity,
				}

				let images = await this.multiUpload();
				if (images.length > 0) {
					this.data.images = images;
				}

				let cover = await this.upload();
				if (cover) {
					this.data.cover = cover;
				}

    			axios.post('/dashboard/venues', vm.data)
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