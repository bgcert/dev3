<template>
	<div>
		<div class="ui segments">
			<div class="ui segment">
				<h4>Ново събитие</h4>
			</div>
			
			<div class="ui segment">
				<el-form ref="form" :model="form" label-width="120px">

					<el-form-item label="Тема">
						<template v-if="errors.theme_id" v-for="error in errors.theme_id">
							 <el-alert type="error" :title="error"></el-alert>
						</template>
						<el-select v-model="selectedTheme" placeholder="Изберете тема">
							<template v-for="theme in themes">
								<el-option :label="theme.title" :value="theme.id"></el-option>	
							</template>
						</el-select>
					</el-form-item>

					<el-form-item label="Лектори">
						<el-select v-model="selectedTeachers" multiple placeholder="Избери преподавател(и)">
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
						<el-select v-model="form.cityId" placeholder="Изберете град">
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
						<el-input v-model="form.address"></el-input>
					</el-form-item>

					<el-form-item label="Начална дата">
						<template v-if="errors.start_date" v-for="error in errors.start_date">
							 <el-alert type="error" :title="error"></el-alert>
						</template>
						<div class="block">
							<el-date-picker
								v-model="form.start_date"
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
								v-model="form.end_date"
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
							v-model="form.start_at"
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
						<template v-if="errors.end_at" v-for="error in errors.end_at">
							 <el-alert type="error" :title="error"></el-alert>
						</template>
						<el-time-select
							v-model="form.end_at"
							:picker-options="{
									start: '08:30',
									step: '00:15',
									end: '18:30'
								}"
							placeholder="Начален час"
							value-format="HH:mm">
						</el-time-select>
					</el-form-item>

					<el-form-item label="Корица">
						<template v-if="coverErrors" v-for="error in coverErrors">
							 <el-alert type="error" :title="error"></el-alert>
						</template>
						<imageUpload :imageUrl="'/img/default_cover.png'"></imageUpload>
					</el-form-item>

					<el-form-item label="Цена">
						<template v-if="errors.price" v-for="error in errors.price">
							 <el-alert type="error" :title="error"></el-alert>
						</template>
						<el-input v-model="form.price" style="width: 150px;">
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
    			selectedTeachers: {},
    			selectedTheme: '',
    			cities: null,
    			form: {
    				theme: '',
    				cityId: null,
    				address: '',
    				start_date: '',
    				end_date: '',
    				start_at: '',
    				end_at: '',
    				price: null,
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
					theme_id: this.selectedTheme,
					city_id: this.form.cityId,
					address: this.form.address,
					price: this.form.price,
					teachers: this.selectedTeachers,
					start_date: this.form.start_date,
					end_date: this.form.end_date,
					start_at: this.form.start_at,
					end_at: this.form.end_at
				}

				try {
					this.data.cover = await this.upload();
				} catch(e) {
				    this.coverErrors = e;
				    return;
				}

    			axios.post('/dashboard/events', vm.data)
    			.then(function (response) {
    				vm.$message('Събитието е добавено успешно.');
    				vm.$router.push('/events');
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