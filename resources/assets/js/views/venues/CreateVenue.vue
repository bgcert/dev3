<template>
	<div>
		<div class="ui segments" v-if="cities != null">
			<div class="ui segment">
				<h4>Нова зала</h4>
			</div>
			
			<div class="ui segment">
				<el-form label-width="160px">
					<el-form-item label="Наименование">
						<template v-if="errors.name" v-for="error in errors.name">
							 <el-alert type="error" :title="error"></el-alert>
						</template>
						<el-input v-model="name"></el-input>
					</el-form-item>

					<el-form-item label="Основна снимка">
						<imageUpload :imageUrl="'/img/default_cover.png'"></imageUpload>
					</el-form-item>

					<el-form-item label="Допълнителни снимки">
						<multi-image-upload></multi-image-upload>
					</el-form-item>

					<el-form-item label="Капацитет">
						<template v-if="errors.capacity" v-for="error in errors.capacity">
							 <el-alert type="error" :title="error"></el-alert>
						</template>
						<el-input v-model="capacity" style="width: 160px;">
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
						<el-input v-model="address"></el-input>
					</el-form-item>
					
					<el-form-item label="Описание">
						<template v-if="errors.description" v-for="error in errors.description">
							 <el-alert type="error" :title="error"></el-alert>
						</template>
						<el-input type="textarea" :rows="12" v-model="description"></el-input>
					</el-form-item>

					<el-form-item label="Цена">
						<template v-if="errors.price" v-for="error in errors.price">
							 <el-alert type="error" :title="error"></el-alert>
						</template>
						<el-input v-model="price" style="width: 200px;">
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

    			axios.post('/dashboard/venues', vm.data)
    			.then(function (response) {
    				vm.$message('Залата е добавена успешно.');
    				vm.$router.push('/venues');
    			})
    			.catch(function (error) {
    				vm.errors = error.response.data;
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
			});
        },

        created() {

        }
    };
</script>