<template>
	<div>
		<div class="ui segments">
			<div class="ui segment">
				<h4>Редактиране на зала</h4>
			</div>
			
			<div class="ui segment" v-if="!loading">
				<el-form label-width="160px">
					<el-form-item label="Наименование">
						<template v-if="errors.name" v-for="error in errors.name">
							 <el-alert type="error" :title="error"></el-alert>
						</template>
						<el-input v-model="venue.name"></el-input>
					</el-form-item>
					<el-form-item label="Основна снимка">
						<imageUpload :imageUrl="'https://d3cwccg7mi8onu.cloudfront.net/fit-in/250x150/' + venue.cover"></imageUpload>
					</el-form-item>

					<el-form-item label="Допълнителни снимки">
						<multi-image-upload :existingImages="venue.venue_images" @detachClick="handleDetach"></multi-image-upload>
					</el-form-item>

					<el-form-item label="Капацитет">
						<template v-if="errors.capacity" v-for="error in errors.capacity">
							 <el-alert type="error" :title="error"></el-alert>
						</template>
						<el-input v-model="venue.capacity" style="width: 160px;">
							<template slot="append">места</template>
						</el-input>
					</el-form-item>

					<el-form-item label="Град">
						<template v-if="errors.city_id" v-for="error in errors.city_id">
							 <el-alert type="error" :title="error"></el-alert>
						</template>
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
						<template v-if="errors.address" v-for="error in errors.address">
							 <el-alert type="error" :title="error"></el-alert>
						</template>
						<el-input v-model="venue.address"></el-input>
					</el-form-item>
					
					<el-form-item label="Описание">
						<template v-if="errors.description" v-for="error in errors.description">
							 <el-alert type="error" :title="error"></el-alert>
						</template>
						<el-input type="textarea" :rows="12" v-model="venue.description"></el-input>
					</el-form-item>

					<el-form-item label="Цена">
						<template v-if="errors.price" v-for="error in errors.price">
							 <el-alert type="error" :title="error"></el-alert>
						</template>
						<el-input v-model="venue.price" style="width: 200px;">
							<template slot="append">.00 лв. с ДДС</template>
						</el-input>
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
				detached: [],
				data: {},
				errors: [],
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
					name: this.venue.name,
					description: this.venue.description,
					city_id: this.cityId,
					address: this.venue.address,
					capacity: this.venue.capacity,
					price: this.venue.price,
					capacity: this.venue.capacity
				}

				try {
					this.data.cover = await this.upload();
				} catch(e) {
				    this.data.cover = null;
				}

				if (this.detached) {
					this.data.detached = this.detached;
				}

				let route = '/dashboard/venues/' + this.$route.params.id;

    			axios.patch(route, vm.data)
    			.then(function (response) {
    				vm.$message('Залата е редактирана успешно.');
    				vm.$router.push('/venues');
    			})
    			.catch(function (error) {
    				vm.errors = error.response.data;
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