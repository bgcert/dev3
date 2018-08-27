<template>
	<div>
		<template v-if="event.id">

			<div class="ui segments">
				<div class="ui secondary segment">
					<h4>Редактиране на събитие</h4>
				</div>
				
				<div class="ui segment">
					<h3>{{ event.theme.title }}</h3>
					<el-form ref="form" :model="form" label-width="120px">

						<el-form-item label="Корица">
							<ImageUpload
								:img="event.cover">
							</ImageUpload>
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

						<el-form-item label="Дати">
							<el-date-picker
								v-model="date"
								type="datetimerange"
								range-separator="To"
								start-placeholder="Начална дата"
								end-placeholder="Крайна дата"
								value-format="yyyy-MM-dd HH:mm:ss">
							</el-date-picker>
						</el-form-item>

						<el-form-item label="Цена">
							<el-input v-model="event.price"></el-input>
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
    			selectedTeachers: [],
    			date: [],
    		}
    	},

    	methods: {
    		save() {
    			let vm = this;
    			let image;

    			let formData = new FormData();
    			// Needed for patch request with form data
    			formData.append('_method', 'patch');
				formData.append('teachers', this.selectedTeachers);
				formData.append('price', this.event.price);
				formData.append('begin_at', this.date[0]);
				formData.append('end_at', this.date[1]);

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
	    				console.log(response);
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
        		console.log(response.data);
        		vm.event = response.data[0];
        		
        		for (let key in response.data[0].teachers) {
				    vm.selectedTeachers.push(response.data[0].teachers[key].id);
				}

        		vm.date[0] = response.data[0].begin_at;
        		vm.date[1] = response.data[0].end_at;
        		vm.teachers = response.data[1];
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