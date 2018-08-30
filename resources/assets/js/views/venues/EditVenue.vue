<template>
	<div>
		<div class="ui segments">
			<div class="ui segment">
				<h4>Редактиране на зала</h4>
			</div>
			
			<div class="ui segment" v-if="!loading">
				<el-form label-width="160px">
					<el-form-item label="Наименование">
						<el-input v-model="venue.name"></el-input>
					</el-form-item>
					<el-form-item label="Основна снимка">
						<ImageUpload :img="'/photos/ve/m/' + venue.cover"></ImageUpload>
					</el-form-item>

					<el-form-item label="Капацитет">
						<el-input v-model="venue.capacity" style="width: 160px;">
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
						<el-input v-model="venue.address"></el-input>
					</el-form-item>
					
					<el-form-item label="Описание">
						<el-input type="textarea" :rows="12" v-model="venue.description"></el-input>
					</el-form-item>

					<el-form-item label="Цена">
						<el-input v-model="venue.price" style="width: 200px;">
							<template slot="append">.00 лв. с ДДС</template>
						</el-input>
					</el-form-item>

					<el-form-item label="Допълнителни снимки">
						<UploadMany
							:images="venue.venue_images"
							@detachClick="handleDetach">
						</UploadMany>
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
    			venue: [],
				imageList: [],
				cities: null,
				cityId: null,
				detached: []
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
    			formData.append('_method', 'patch');
				formData.append('name', this.venue.name);
				formData.append('description', this.venue.description);
				formData.append('city_id', this.cityId);
				formData.append('address', this.venue.address);
				formData.append('capacity', this.venue.capacity);
				formData.append('price', this.venue.price);
				formData.append('capacity', this.venue.capacity);

				let config =
					{
						header : {
							'Content-Type' : 'multipart/form-data'
						}
					}
    	// 		let data = {
    	// 			_method: 'PUT',
					// name: vm.venue.name,
					// description: vm.venue.description,
					// city_id: vm.cityId,
					// address: vm.venue.address,
					// capacity: vm.venue.capacity,
					// price: vm.venue.price
    	// 		}

    			let cover = await this.uploadCover();
    			this.imageList = await this.uploadImages();

    			if (this.imageList) {
    				formData.append('images', this.imageList)
    				// data.images = this.imageList;
    			}
    			if (cover) {
    				formData.append('cover', cover)
    				// data.cover = this.cover;
    			}
    			if (this.detached) {
    				data.detached = this.detached;
    			}


    			let route = '/dashboard/venues/' + this.$route.params.id;

    			axios.post(route, formData, config)
	    			.then(function (response) {
	    				vm.$message('Залата е добавена успешно.');
	    				vm.$router.push('/venues');
	    			})
	    			.catch(function (error) {
	    				console.log(error);
	    			})
    		},
    		handleDetach(id) {
    			this.detached.push(id);
    		}
    	},

        mounted() {
            console.log('New venue view mounted.')
        },

        created() {
        	let vm = this;
        	let route = '/dashboard/venues/' + this.$route.params.id + '/edit';
        	axios.get(route)
    			.then(function (response) {
    				vm.venue = response.data[0];
    				vm.imageList = response.data[1];
    				vm.cities = response.data[2];
    				vm.cityId = response.data[0].city_id;
    				vm.loading = false;
    			})
    			.catch(function (error) {
    				console.log(error);
    			})
        }
    };
</script>