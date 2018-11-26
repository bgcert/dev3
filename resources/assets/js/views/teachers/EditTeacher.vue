<template>
	<div class="card">
		<div class="card-header">
			Редактиране на лектор
		</div>

		<div class="card-body" v-if="!loading">
			<div class="form-group">
				<label>Име</label>
				<input type="text" name="name" class="form-control" :class="{ 'is-invalid': errors.name }" v-model="teacher.name" autofocus required>
				<div class="invalid-feedback" v-if="errors.name">
					{{ errors.name[0] }}
				</div>
			</div>

			<div class="form-group">
				<imageUpload :imageUrl="'https://d3cwccg7mi8onu.cloudfront.net/250x150/' + teacher.image"></imageUpload>
			</div>

			<div class="form-group">
				<label>Съдържание</label>
				<textarea class="form-control" :class="{ 'is-invalid': errors.details }" v-model="teacher.details" required></textarea>
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
    			teacher: [],
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
					name: this.teacher.name,
					details: this.teacher.details,
				}

				try {
					this.data.image = await this.upload();
				} catch(e) {
				    this.data.image = null;
				}

				let route = '/dashboard/teachers/' + this.$route.params.id;

    			axios.patch(route, vm.data)
    			.then(function (response) {
    				vm.$message('Лекторът е редактиран успешно.');
    				vm.$router.push('/teachers');
    			})
    			.catch(function (error) {
    				vm.errors = error.response.data;
    			})
    		}
    	},

        mounted() {
            console.log('Edit teacher view mounted.')
        },

        created() {
        	var vm = this;
            var route = '/dashboard/teachers/' +  this.$route.params.id + '/edit';
        	axios.get(route).then(function (response) {
        		console.log(response.data);
        		vm.teacher = response.data;
        		//vm.categories = response.data[1];
        		vm.loading = false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>