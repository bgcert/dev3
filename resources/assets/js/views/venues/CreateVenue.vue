<template>
	<div class="card" v-loading="loading">
		<div class="card-header">
			Нова зала
		</div>

		<div class="card-body">

			<div v-if="cities != null">

				<div class="form-group">
					<label>Наименование</label>
					<input type="text" name="name" class="form-control" :class="{ 'is-invalid': errors.name }" v-model="name" autofocus required>
					<div class="invalid-feedback" v-if="errors.name">
						{{ errors.name[0] }}
					</div>
				</div>

				<div class="form-group">
					<label>Основна снимка</label>
					<imageUpload :imageUrl="'/img/default_cover.png'"></imageUpload>
				</div>

				<div class="form-group">
					<label>Допълнителни снимки</label>
					<multi-image-upload></multi-image-upload>
				</div>

				<div class="form-group">
					<label>Капацитет</label>
					<input type="text" name="capacity" class="form-control col-2" :class="{ 'is-invalid': errors.capacity }" v-model="capacity" required>
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
					<input type="text" name="address" class="form-control" :class="{ 'is-invalid': errors.address }" v-model="address" required>
					<div class="invalid-feedback" v-if="errors.address">
						{{ errors.address[0] }}
					</div>
				</div>

				<div class="form-group">
					<label>Описание</label>
					<textarea class="form-control" :class="{ 'is-invalid': errors.description }" rows="6" v-model="description"></textarea>
					<div class="invalid-feedback" v-if="errors.description">
						{{ errors.description[0] }}
					</div>
				</div>

				<div class="form-group">
					<label>Цена</label>
					<input type="text" class="form-control col-2" :class="{ 'is-invalid': errors.price }" v-model="price">
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
				data: {},
    			errors: [],
    			imagesErrors: []
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
    			vm.loading = true;

				this.data = {
					name: this.name,
					description: this.description,
					city_id: this.cityId,
					address: this.address,
					capacity: this.capacity,
					price: this.price,
					capacity: this.capacity,
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

    			axios.post('/dashboard/venues', vm.data)
    			.then(function (response) {
    				vm.$message('Залата е добавена успешно.');
    				vm.$router.push('/venues');
    			})
    			.catch(function (error) {
    				vm.errors = error.response.data;
    			})
    			.then(function (response) {
	            	vm.loading = false;
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
				vm.errors = error.response.data;
			})
			.then(function (response) {
            	vm.loading = false;
			});
        },

        created() {

        }
    };
</script>