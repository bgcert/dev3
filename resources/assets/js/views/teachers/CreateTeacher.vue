<template>
	<div class="card">
		<div class="card-header">
			Нов лектор
		</div>

		<div class="card-body">
			<div class="form-group">
				<label>Име</label>
				<input type="text" name="name" class="form-control" :class="{ 'is-invalid': errors.name }" v-model="form.name" autofocus required>
				<div class="invalid-feedback" v-if="errors.name">
					{{ errors.name[0] }}
				</div>
			</div>

			<div class="form-group">
				<imageUpload :imageUrl="'/img/default_cover.png'"></imageUpload>
			</div>

			<div class="form-group">
				<label>Съдържание</label>
				<textarea class="form-control" :class="{ 'is-invalid': errors.details }" v-model="form.details" required></textarea>
				<div class="invalid-feedback" v-if="errors.details">
					{{ errors.details[0] }}
				</div>
			</div>

			<div class="form-group">
				<div class="d-flex justify-content-end">
					<router-link to="/teachers" class="btn btn-outline-secondary mr-2">
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
    			form: {
    				name: '',
    				details: '',
    			},
    			data: {},
    			errors: []
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
					name: this.form.name,
					details: this.form.details,
				}

				try {
					this.data.image = await this.upload();
				} catch(e) {
				    this.data.image = null;
				}

    			axios.post('/dashboard/teachers', vm.data)
    			.then(function (response) {
    				vm.$message('Лекторът е добавен успешно.');
    				vm.$router.push('/teachers');
    			})
    			.catch(function (error) {
    				vm.errors = error.response.data;
    			})
    		}
    	},

        mounted() {
            console.log('Create teacher view mounted.')
        },

        created() {

        }
    };
</script>