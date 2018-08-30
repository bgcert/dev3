<template>
	<div>
		<template v-if="event.id">

			<div class="ui segments">
				<div class="ui secondary segment">
					<h4>Редактиране на събитие</h4>
				</div>
				
				<div class="ui segment">
					<el-form label-width="120px">
						<el-form-item>
							<h3>Тема: {{ event.theme.title }}</h3>
						</el-form-item>

						<el-form-item label="Корица">
							<ImageUpload :img="'photos/ev/m/' + event.cover"></ImageUpload>
						</el-form-item>

						<el-form-item label="Лектори">
							<el-select v-model="selectedTeachers" multiple placeholder="Select">
								<el-option
									v-for="teacher in teachers"
									:key="teacher.id"
									:label="teacher.name"
									:value="teacher.id">
								</el-option>
							</el-select>
						</el-form-item>

						<el-form-item label="Град">
							<el-select v-model="event.city_id" placeholder="Изберете град">
								<el-option
									v-for="city in cities"
									:key="city.id"
									:label="city.name"
									:value="city.id">
								</el-option>
							</el-select>
						</el-form-item>

						<el-form-item label="Адрес">
							<el-input v-model="event.address"></el-input>
						</el-form-item>

						<el-form-item label="Начална дата">
							<div class="block">
								<el-date-picker
									v-model="event.start_date"
									type="date"
									placeholder="Начална дата"
									value-format="yyyy-MM-dd">
								</el-date-picker>
							</div>
						</el-form-item>

						<el-form-item label="Крайна дата">
							<div class="block">
								<el-date-picker
									v-model="event.end_date"
									type="date"
									placeholder="Крайна дата"
									value-format="yyyy-MM-dd">
								</el-date-picker>
							</div>
						</el-form-item>

						<el-form-item label="Начален час">
							<el-time-select
								v-model="event.start_at"
								:picker-options="{
										start: '08:30',
										step: '00:15',
										end: '18:30'
									}"
								placeholder="Начален час"
								value-format="HH:mm">
							</el-time-select>
						</el-form-item>

						<el-form-item label="Краен час">
							<el-time-select
								v-model="event.end_at"
								:picker-options="{
										start: '08:30',
										step: '00:15',
										end: '18:30'
									}"
								placeholder="Начален час"
								value-format="HH:mm">
							</el-time-select>
						</el-form-item>

						<el-form-item label="Цена">
							<el-input v-model="event.price" style="width: 150px;">
								<template slot="append">лв.</template>
							</el-input>
						</el-form-item>

						<el-form-item>
							<div class="ui warning message">
								Моля, посочете крайната цена с начислен ДДС.
							</div>
						</el-form-item>

						<el-form-item>
							<div class="right floated">
								<div class="ui right floated primary button" @click="save">
						        	Запиши
						        </div>
								<router-link to="/events" class="item">
									<div class="ui right floated basic button">
							        	Откажи
							        </div>
								</router-link>	
							</div>
						</el-form-item>

					</el-form>
				</div>
			</div>
		</template>
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
    			event: {},
    			themes: [],
    			teachers: [],
    			cities: null,
    			selectedTeachers: [],
    			// date: [],
    		}
    	},

    	methods: {
    		save() {
    			let vm = this;
    			let image;

    			let formData = new FormData();
    			// Needed for patch request with form data
    			formData.append('_method', 'patch');

				formData.append('city_id', this.event.city_id);
				formData.append('address', this.event.address);
				formData.append('price', this.event.price);
				formData.append('teachers', this.selectedTeachers);
				formData.append('start_date', this.event.start_date);
				formData.append('end_date', this.event.end_date);
				formData.append('start_at', this.event.start_at);
				formData.append('end_at', this.event.end_at);

    			let config =
					{
						header : {
							'Content-Type' : 'multipart/form-data'
						}
					}

    			let upload = new Promise((resolve, reject) => EventBus.$emit('imageSave', resolve, reject));

				upload.then((data) => {
					// Append if file selected
					if (data) {
						formData.append('file', data);
					}

					let route = '/dashboard/events/' + this.$route.params.id;
					axios.post(route, formData, config)
	    			.then(function (response) {
	    				vm.$message('Събитието е редактирано.');
    					vm.$router.push('/events');
	    			})
	    			.catch(function (error) {
	    				console.log(error);
	    			});
				}, (error) => {
					console.log('Promise rejected.');
					vm.$message('Невалидно изображение');
				});
    		}
    	},

        mounted() {
            console.log('Edit event view mounted.')
        },

        created() {
        	var vm = this;
            var route = '/dashboard/events/' + this.$route.params.id + '/edit';
        	axios.get(route).then(function (response) {
        		vm.event = response.data[0];
        		
        		for (let key in response.data[0].teachers) {
				    vm.selectedTeachers.push(response.data[0].teachers[key].id);
				}

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

<style>


</style>