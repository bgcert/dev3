<template>
	<div class="card" v-loading="loading">
		<div class="card-header">
			Ново събитие
		</div>

		<div class="card-body">

			<div class="form-group">
				<label>Тема</label>
				<select class="custom-select" :class="{ 'is-invalid': errors.theme_id }" v-model="selectedTheme" required>
					<option value="" disabled selected>Изберете тема</option>
					<option v-for="theme in themes" :value="theme.id">{{ theme.title }}</option>
				</select>
				<div class="invalid-feedback" v-if="errors.theme_id">
					{{ errors.theme_id[0] }}
				</div>
			</div>

			<div class="form-group">
				<label>Преподаватели</label>
				<div class="form-check" v-for="(teacher, index) in teachers">
					<input class="form-check-input" type="checkbox" :value="teacher.id" :id="'teacher' + teacher.id" v-model="selectedTeachers">
					<label class="form-check-label" :for="'teacher' + teacher.id">
						{{ teacher.name }}
					</label>
				</div>
			</div>

			<div class="form-group">
				<label>Град</label>
				<select class="custom-select" :class="{ 'is-invalid': errors.city_id }" v-model="form.cityId" required>
					<option value="" disabled selected>Изберете град</option>
					<option v-for="city in cities" :value="city.id">{{ city.name }}</option>
				</select>
				<div class="invalid-feedback" v-if="errors.city_id">
					{{ errors.city_id[0] }}
				</div>
			</div>

			<div class="form-group">
				<label>Адрес</label>
				<input type="text" name="address" class="form-control" :class="{ 'is-invalid': errors.address }" v-model="form.address" required>
				<div class="invalid-feedback" v-if="errors.address">
					{{ errors.address[0] }}
				</div>
			</div>

			<div class="form-group">
				<label>Корица</label>
				<imageUpload :imageUrl="'/img/default_cover.png'"></imageUpload>
			</div>

			<div class="form-group">
				<label>Начална дата</label>
				<div class="form-control p-0 mb-1" :class="{ 'is-invalid': errors.start_date }" style="border: none;">
					<el-date-picker
						v-model="form.start_date"
						:picker-options="startDatePickerOptions"
						type="date"
						placeholder="Начална дата"
						value-format="yyyy-MM-dd">
					</el-date-picker>
				</div>
				<div class="invalid-feedback" v-if="errors.start_date">
					{{ errors.start_date[0] }}
				</div>
			</div>

			<div class="form-group">
				<label>Крайна дата</label>
				<div class="form-control p-0 mb-1" :class="{ 'is-invalid': errors.end_date }" style="border: none;">
					<el-date-picker
						v-model="form.end_date"
						:picker-options="endDatePickerOptions"
						type="date"
						placeholder="Крайна дата"
						value-format="yyyy-MM-dd">
					</el-date-picker>
				</div>
				<div class="invalid-feedback" v-if="errors.end_date">
					{{ errors.end_date[0] }}
				</div>
			</div>

			<div class="form-group">
				<label>Начален час</label>
				<div class="form-control p-0 mb-1" :class="{ 'is-invalid': errors.start_at }" style="border: none;">
					<el-time-select
						v-model="form.start_at"
						:picker-options="{ start: '06:00', end: '23:00', step: '00:15', maxTime: form.end_at }"
						placeholder="Начален час"
						value-format="HH:mm">
					</el-time-select>
				</div>
				<div class="invalid-feedback" v-if="errors.start_at">
					{{ errors.start_at[0] }}
				</div>
			</div>

			<div class="form-group">
				<label>Краен час</label>
				<div class="form-control p-0 mb-1" :class="{ 'is-invalid': errors.end_at }" style="border: none;">
					<el-time-select
						v-model="form.end_at"
						:picker-options="{ start: '06:00', end: '23:00', step: '00:15', minTime: form.start_at }"
						placeholder="Краен час"
						value-format="HH:mm">
					</el-time-select>
				</div>
				<div class="invalid-feedback" v-if="errors.end_at">
					{{ errors.end_at[0] }}
				</div>
			</div>

			<div class="form-group">
				<label>Цена</label>
				<input type="text" name="price" class="form-control col-2" :class="{ 'is-invalid': errors.price }" v-model="form.price">
				<div class="invalid-feedback" v-if="errors.price">
					{{ errors.price[0] }}
				</div>
			</div>

			<div class="alert alert-warning" role="alert">
				Моля, посочете крайната цена с начислен ДДС.
			</div>

			<div class="form-group">
				<div class="form-check">
					<input class="form-check-input" type="checkbox" value="" id="active" v-model="form.active">
					<label class="form-check-label" for="active">
						Активно
					</label>
				</div>
			</div>

			<div class="form-group">
				<div class="d-flex justify-content-end">
					<router-link to="/events" class="btn btn-outline-secondary mr-2">
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
    	components: { ImageUpload },
    	data: function () {
    		return {
    			loading: true,
    			themes: [],
    			teachers: [],
    			selectedTeachers: [],
    			selectedTheme: '',
    			cities: null,
    			form: {
    				theme: '',
    				cityId: '',
    				address: '',
    				start_date: '',
    				end_date: '',
    				start_at: '',
    				end_at: '',
    				price: null,
    				active: true
    			},
    			data: {},
    			errors: [],
    			startDatePickerOptions: {
    				disabledDate (date) {
    					return date <= new Date();
    				}
    			},
    			endDatePickerOptions: {
    				disabledDate (date) {
    					return date <= new Date();
    				}
    			}
    		}
    	},

    	methods: {

    		selectTeacher(id) {
    			console.log(id);
    		},

    		upload() {
    			let promise = new Promise((resolve, reject) => EventBus.$emit('upload', resolve, reject));
    			return promise;
    		},

    		async save() {
    			let vm = this;
    			vm.loading = true;

				this.data = {
					theme_id: this.selectedTheme,
					city_id: this.form.cityId,
					address: this.form.address,
					price: this.form.price,
					active: this.form.active,
					teachers: this.selectedTeachers,
					start_date: this.form.start_date,
					end_date: this.form.end_date,
					start_at: this.form.start_at,
					end_at: this.form.end_at
				}

				try {
					this.data.cover = await this.upload();
				} catch(e) {
				    this.data.cover = null;
				}

    			axios.post('/dashboard/events', vm.data)
    			.then(function (response) {
    				vm.$message('Събитието е добавено успешно.');
    				vm.$router.push('/events');
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
            console.log('New theme view mounted.')
        },

        created() {
        	var vm = this;
            var route = '/dashboard/events/create';
        	axios.get(route).then(function (response) {
        		console.log(response.data);
        		vm.themes = response.data[0];
        		vm.teachers = response.data[1];
        		vm.cities = response.data[2];
        		vm.loading = false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>