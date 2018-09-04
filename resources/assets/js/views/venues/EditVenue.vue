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
						<imageUpload
							:imageUrl="'/photos/' + venue.cover"
							:route="'/dashboard/venue/cover/upload'">
						</imageUpload>
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
						<multi-image-upload
							:existingImages="venue.venue_images"
							:route="'/dashboard/venue/image/upload'"
							@detachClick="handleDetach">
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
    			venue: [],
				imageList: [],
				cities: null,
				cityId: null,
				detached: []
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
				let data = {
					name: this.venue.name,
					description: this.venue.description,
					city_id: this.cityId,
					address: this.venue.address,
					capacity: this.venue.capacity,
					price: this.venue.price,
					capacity: this.venue.capacity
				}

				let images = await this.multiUpload();

				if (images != null) {
					data.images = images;
				}

				let cover = await this.upload();

				if (cover) {
					data.cover = cover;
				}

				if (this.detached) {
					data.detached = this.detached;
				}

				let route = '/dashboard/venues/' + this.$route.params.id;

    			axios.patch(route, data)
    			.then(function (response) {
    				vm.$message('Залата е редактирана успешно.');
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