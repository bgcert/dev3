<template>
	<div>
		<div class="ui segments">
			<div class="ui segment">
				<h4>Редактиране на зала</h4>
			</div>
			
			<div class="ui segment" v-if="venue">
				<el-form label-width="160px">
					<el-form-item label="Наименование">
						<el-input v-model="venue.name"></el-input>
					</el-form-item>

					<el-form-item label="Основна снимка">
						<ImageUpload
							:image="venue.cover">
						</ImageUpload>
					</el-form-item>

					<el-form-item label="Капацитет">
						<el-input v-model="venue.capacity"></el-input>
					</el-form-item>
					
					<el-form-item label="Описание">
						<el-input type="textarea" :rows="12" v-model="venue.description"></el-input>
					</el-form-item>

					<el-form-item label="Цена">
						<el-input v-model="venue.price"></el-input>
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
	import ImageUpload from '../../components/UploadComponent.vue'
	import UploadMany from '../../components/UploadManyComponent.vue'
    export default {
    	components: {
			ImageUpload, UploadMany
		},
    	data: function () {
    		return {
    			loading: true,
    			venue: {},
				imageList: [],
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

    			let data = {
    				_method: 'PUT',
					name: vm.venue.name,
					description: vm.venue.description,
					capacity: vm.venue.capacity,
					price: vm.venue.price
    			}

    			this.cover = await this.uploadCover();
    			this.imageList = await this.uploadImages();

    			if (this.imageList) {
    				data.images = this.imageList;
    			}
    			if (this.cover) {
    				data.cover = this.cover;
    			}
    			if (this.detached) {
    				data.detached = this.detached;
    			}


    			let route = '/dashboard/venues/' + this.$route.params.id;

    			axios.post(route, data)
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
    				vm.venue = response.data;
    				vm.imageList = response.data[1];
    			})
    			.catch(function (error) {
    				console.log(error);
    			})
        }
    };
</script>