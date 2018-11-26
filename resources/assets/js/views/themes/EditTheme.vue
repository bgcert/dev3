<template>
	<div class="card">
		<div class="card-header">
			Редактиране на тема
		</div>
		<div v-if="!loading" class="card-body">
			<div class="form-group">
				<label>Заглавие</label>
				<input type="text" name="title" class="form-control" :class="{ 'is-invalid': errors.title }" v-model="theme.title" autofocus required>
				<div class="invalid-feedback" v-if="errors.title">
					{{ errors.title[0] }}
				</div>
			</div>

			<div class="form-group">
				<label>Категория</label>
				<select class="custom-select" :class="{ 'is-invalid': errors.category_id }" v-model="theme.category_id" placeholder="Изберете категория" required>
					<option value="" disabled selected>Изберете категория</option>
					<option v-for="category in categories" :value="category.id">{{ category.name }}</option>
				</select>
				<div class="invalid-feedback" v-if="errors.category_id">
					{{ errors.category_id[0] }}
				</div>
			</div>

			<div class="form-group">
				<label>Корица</label>
				<imageUpload :imageUrl="'https://d3cwccg7mi8onu.cloudfront.net/250x150/' + theme.cover"></imageUpload>
			</div>

			<div class="form-group">
				<label>Кратко описание</label>
				<textarea class="form-control" :class="{ 'is-invalid': errors.excerpt }" rows="3" v-model="theme.excerpt"></textarea>
				<div class="invalid-feedback" v-if="errors.excerpt">
					{{ errors.excerpt[0] }}
				</div>
			</div>

			<div class="form-group">
				<label>Съдържание</label>
				<textarea class="form-control" :class="{ 'is-invalid': errors.body }" rows="6" v-model="theme.body"></textarea>
				<div class="invalid-feedback" v-if="errors.body">
					{{ errors.body[0] }}
				</div>
			</div>

			<div class="form-group">
				<label>Учебни часове</label>
				<input type="text" class="form-control col-2" :class="{ 'is-invalid': errors.duration }" v-model="theme.duration">
				<div class="invalid-feedback" v-if="errors.duration">
					{{ errors.duration[0] }}
				</div>
			</div>

			<div class="form-group">
				<div class="d-flex justify-content-end">
					<router-link to="/themes" class="btn btn-outline-secondary mr-2">
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
	import { EventBus } from '../../app'
	import ImageUpload from '../../components/ImageUploadComponent.vue'
    export default {
    	components: {
			ImageUpload
		},

    	data: function () {
    		return {
    			show: false,
    			loading: true,
    			selectedFile: null,
    			categories: [],
    			theme: [],
    			errors: [],
    			coverErrors: []
    		}
    	},

    	methods: {
    		upload() {
    			let promise = new Promise((resolve, reject) => EventBus.$emit('upload', resolve, reject));
    			return promise;
    		},
    		
    		async save() {
    			let vm = this;
				let data = {
					title: this.theme.title,
					body: this.theme.body,
					excerpt: this.theme.excerpt,
					duration: this.theme.duration,
					category_id: this.theme.category_id,
				}

				try {
					data.cover = await this.upload();
				} catch(e) {
				    data.cover = null;
				}

				let route = '/dashboard/themes/' + this.$route.params.id;

    			axios.patch(route, data)
    			.then(function (response) {
    				vm.$message('Темата е редактирана успешно.');
    				vm.$router.push('/themes');
    			})
    			.catch(function (error) {
    				vm.errors = error.response.data;
    			})
    		}
    	},

        mounted() {
            console.log('Edit theme view mounted.');
        },

        created() {

        	var vm = this;
            var route = '/dashboard/themes/' + this.$route.params.id + '/edit';
        	axios.get(route).then(function (response) {
        		vm.theme = response.data[0];
        		vm.categories = response.data[1];
        		vm.loading = false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>

<style>
	
</style>

