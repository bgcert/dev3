<template>
	<div class="card">
		<div class="card-header">
			Редактиране на зала
		</div>

		<div class="card-body" v-if="!loading">

			<div class="form-group">
				<label>Наименование</label>
				<input type="text" name="name" class="form-control" :class="{ 'is-invalid': errors.name }" v-model="venue.name" autofocus required>
				<div class="invalid-feedback" v-if="errors.name">
					{{ errors.name[0] }}
				</div>
			</div>

			<div class="form-group">
				<label>Основна снимка</label>
				<imageUpload :imageUrl="'https://d3cwccg7mi8onu.cloudfront.net/fit-in/250x150/' + venue.cover"></imageUpload>
			</div>

			<div class="form-group">
				<label>Допълнителни снимки</label>
				<multi-image-upload :existingImages="venue.venue_images" @detachClick="handleDetach"></multi-image-upload>
			</div>

			<div class="form-group">
				<label>Капацитет</label>
				<input type="text" name="capacity" class="form-control col-2" :class="{ 'is-invalid': errors.capacity }" v-model="venue.capacity" required>
				<div class="invalid-feedback" v-if="errors.capacity">
					{{ errors.capacity[0] }}
				</div>
			</div>

			<div class="form-group">
				<label>Град</label>
				<select class="custom-select" :class="{ 'is-invalid': errors.city_id }" v-model="cityId" required>
					<option value="" disabled selected>Изберете град</option>
					<option v-for="city in cities" :value="city.id">{{ city.name }}</option>
				</select>
				<div class="invalid-feedback" v-if="errors.city_id">
					{{ errors.city_id[0] }}
				</div>
			</div>

			<div class="form-group">
				<label>Адрес</label>
				<input type="text" name="address" class="form-control" :class="{ 'is-invalid': errors.address }" v-model="venue.address" required>
				<div class="invalid-feedback" v-if="errors.address">
					{{ errors.address[0] }}
				</div>
			</div>

			<div class="form-group">
				<label>Описание</label>
				<textarea class="form-control" :class="{ 'is-invalid': errors.description }" rows="6" v-model="venue.description"></textarea>
				<div class="invalid-feedback" v-if="errors.description">
					{{ errors.description[0] }}
				</div>
			</div>

			<div class="form-group">
				<label>Цена</label>
				<input type="text" class="form-control col-2" :class="{ 'is-invalid': errors.price }" v-model="venue.price">
				<div class="invalid-feedback" v-if="errors.price">
					{{ errors.price[0] }}
				</div>
			</div>

			<div class="alert alert-warning" role="alert">
				Моля, посочете крайната цена с начислен ДДС.
			</div>

			<div class="form-group">
				<div class="d-flex justify-content-end">
					<router-link to="/venues" class="btn btn-outline-secondary mr-2">
						Откажи
					</router-link>

					<div class="btn btn-primary" @click="save">
						Запиши
					</div>
				</div>
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

				try {
					this.data.images = await this.multiUpload();
				} catch(e) {
				    this.data.images = null;
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