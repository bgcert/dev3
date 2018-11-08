<template>
	<div class="segment">
		<h4>Редактиране на събитие</h4>
		<template v-if="event.id">
			<el-form label-width="120px">
				<div class="field">
					<h4>Тема: {{ event.theme.title }}</h4>
				</div>
				<el-form-item>
					
				</el-form-item>

				<el-form-item label="Корица">
					<imageUpload :imageUrl="'https://d3cwccg7mi8onu.cloudfront.net/fit-in/' + event.cover"></imageUpload>
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
					<template v-if="errors.city_id" v-for="error in errors.city_id">
						<el-alert type="error" :title="error"></el-alert>
					</template>
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
					<template v-if="errors.address" v-for="error in errors.address">
						<el-alert type="error" :title="error"></el-alert>
					</template>
					<el-input v-model="event.address"></el-input>
				</el-form-item>

				<el-form-item label="Начална дата">
					<template v-if="errors.start_date" v-for="error in errors.start_date">
						<el-alert type="error" :title="error"></el-alert>
					</template>
					<div class="block">
						<el-date-picker
							v-model="event.start_date"
							:picker-options="startDatePickerOptions"
							type="date"
							placeholder="Начална дата"
							value-format="yyyy-MM-dd">
						</el-date-picker>
					</div>
				</el-form-item>

				<el-form-item label="Крайна дата">
					<template v-if="errors.end_date" v-for="error in errors.end_date">
						<el-alert type="error" :title="error"></el-alert>
					</template>
					<div class="block">
						<el-date-picker
							v-model="event.end_date"
							:picker-options="endDatePickerOptions"
							type="date"
							placeholder="Крайна дата"
							value-format="yyyy-MM-dd">
						</el-date-picker>
					</div>
				</el-form-item>

				<el-form-item label="Начален час">
					<template v-if="errors.start_at" v-for="error in errors.start_at">
						<el-alert type="error" :title="error"></el-alert>
					</template>
					<el-time-select
						v-model="event.start_at"
						:picker-options="{ start: '06:00', end: '23:00', step: '00:15', maxTime: event.end_at }"
						placeholder="Начален час"
						value-format="HH:mm">
					</el-time-select>
				</el-form-item>

				<el-form-item label="Краен час">
					<template v-if="errors.end_at" v-for="error in errors.end_at">
						<el-alert type="error" :title="error"></el-alert>
					</template>
					<el-time-select
						v-model="event.end_at"
						:picker-options="{ start: '06:00', end: '23:00', step: '00:15', minTime: event.start_at }"
						placeholder="Начален час"
						value-format="HH:mm">
					</el-time-select>
				</el-form-item>

				<el-form-item label="Цена">
					<template v-if="errors.price" v-for="error in errors.price">
						<el-alert type="error" :title="error"></el-alert>
					</template>
					<el-input v-model="event.price" style="width: 150px;">
						<template slot="append">лв.</template>
					</el-input>
				</el-form-item>

				<div class="field">
					<div class="message orange">
						Моля, посочете крайната цена с начислен ДДС.
					</div>
				</div>

				<el-form-item>
					<input type="checkbox" id="active" v-model="event.active"/>
					<label for="active">Активно</label>
				</el-form-item>

				<div class="field right">
					<div class="btn blue" @click="save">
			        	Запиши
			        </div>
					<router-link to="/events" class="btn basic">
						Откажи
					</router-link>	
				</div>

			</el-form>
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
    		upload() {
    			let promise = new Promise((resolve, reject) => EventBus.$emit('upload', resolve, reject));
    			return promise;
    		},
    		
    		async save() {
    			let vm = this;

    			let data = {
					city_id: this.event.city_id,
					address: this.event.address,
					price: this.event.price,
					active: this.event.active,
					teachers: this.selectedTeachers,
					start_date: this.event.start_date,
					end_date: this.event.end_date,
					start_at: this.event.start_at,
					end_at: this.event.end_at
				}

				try {
					data.cover = await this.upload();
				} catch(e) {
				    data.cover = null;
				}

				let route = '/dashboard/events/' + this.$route.params.id;

    			axios.patch(route, data)
    			.then(function (response) {
    				vm.$message('Събитиети е редактирано успешно.');
    				vm.$router.push('/events');
    			})
    			.catch(function (error) {
    				vm.errors = error.response.data;
    			})
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