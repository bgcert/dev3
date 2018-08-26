<template>
	<div>
		<div class="ui segments">
			<div class="ui segment">
				<h4>Ново събитие</h4>
			</div>
			
			<div class="ui segment">
				<el-form ref="form" :model="form" label-width="120px">

					<el-form-item label="Тема">
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

					<el-form-item label="Дати">
						<el-date-picker
							v-model="form.date"
							type="datetimerange"
							range-separator="To"
							start-placeholder="Начална дата"
							end-placeholder="Крайна дата"
							value-format="yyyy-MM-dd HH:mm:ss">
						</el-date-picker>
					</el-form-item>

					<el-form-item label="Корица">
							<ImageUpload></ImageUpload>
					</el-form-item>

					<el-form-item label="Цена">
						<el-input v-model="form.price"></el-input>
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
    			form: {
    				theme: '',
    				date: '',
    				data1: '',
    				cover: 'https://picsum.photos/800/400/?image=293',
    				price: null,
    			}
    		}
    	},

    	methods: {
    		save() {
    			let vm = this;
    			let image;

    			let formData = new FormData();
				formData.append('theme_id', this.selectedTheme);
				formData.append('price', this.form.price);
				formData.append('teachers', this.selectedTeachers);
				formData.append('begin_at', this.form.date[0]);
				formData.append('end_at', this.form.date[1]);

    			let config =
					{
						header : {
							'Content-Type' : 'multipart/form-data'
						}
					}

    			let upload = new Promise((resolve, reject) => EventBus.$emit('imageSave', resolve, reject));

				upload.then((data) => {
					formData.append('file', data);

					axios.post('/dashboard/events', formData, config)
	    			.then(function (response) {
	    				console.log(response);
	    				vm.$message('Събитието е създадено успешно.');
    					vm.$router.push('/events');
	    			})
	    			.catch(function (error) {
	    				console.log(error);
	    			});
				}, (error) => {
					console.log(error);
					vm.$message('Невалидно изображение');
				});
    		},
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
        		vm.loading = false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    }
</script>