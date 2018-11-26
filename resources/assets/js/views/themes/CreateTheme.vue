<template>
	<div class="card">
		<div class="card-header">
			Нова тема
		</div>

		<div class="card-body">
			<div class="form-group">
				<label>Заглавие</label>
				<input type="text" name="title" class="form-control" :class="{ 'is-invalid': errors.title }" v-model="form.title" autofocus required>
				<div class="invalid-feedback" v-if="errors.title">
					{{ errors.title[0] }}
				</div>
			</div>

			<div class="form-group">
				<label>Категория</label>
				<select class="custom-select" :class="{ 'is-invalid': errors.category_id }" v-model="form.category" placeholder="Изберете категория" required>
					<option value="" disabled selected>Изберете категория</option>
					<option v-for="category in categories" :value="category.id">{{ category.name }}</option>
				</select>
				<div class="invalid-feedback" v-if="errors.category_id">
					{{ errors.category_id[0] }}
				</div>
			</div>

			<div class="form-group">
				<label>Корица</label>
				<imageUpload :imageUrl="'/img/default_cover.png'"></imageUpload>
			</div>

			<div class="form-group">
				<label>Кратко описание</label>
				<textarea class="form-control" :class="{ 'is-invalid': errors.excerpt }" rows="3" v-model="form.excerpt"></textarea>
				<div class="invalid-feedback" v-if="errors.excerpt">
					{{ errors.excerpt[0] }}
				</div>
			</div>

			<div class="form-group">
				<label>Съдържание</label>
				<textarea class="form-control" :class="{ 'is-invalid': errors.body }" rows="6" v-model="form.body"></textarea>
				<div class="invalid-feedback" v-if="errors.body">
					{{ errors.body[0] }}
				</div>
			</div>

			<div class="form-group">
				<label>Учебни часове</label>
				<input type="text" class="form-control col-2" :class="{ 'is-invalid': errors.duration }" v-model="form.duration">
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
	import { EventBus } from '../../app';
	import ImageUpload from '../../components/ImageUploadComponent.vue'
    export default {
    	components: {
			ImageUpload
		},
    	data: function () {
    		return {
    			loading: true,
    			categories: [],
    			form: {
    				title: '',
    				category: '',
    				body: '',
    				excerpt: '',
    				type: [],
    				duration: null
    			},
    			data: {},
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

				this.data = {
					title: this.form.title,
					body: this.form.body,
					excerpt: this.form.excerpt,
					duration: this.form.duration,
					category_id: this.form.category,
				}

				try {
					this.data.cover = await this.upload();
				} catch(e) {
				    this.data.cover = null;
				}

    			axios.post('/dashboard/themes', vm.data)
    			.then(function (response) {
    				vm.$message('Темата е добавена успешно.');
    				vm.$router.push('/themes');
    			})
    			.catch(function (error) {
    				vm.errors = error.response.data;
    			})
    		}
    	},

        mounted() {
            console.log('New theme view mounted.')
        },

        created() {
        	var vm = this;
            var route = '/dashboard/categories';
        	axios.get(route).then(function (response) {
        		vm.categories = response.data;
        		vm.loading = false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>