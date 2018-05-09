<template>
	<div>
		<template v-if="event.id">

			<div class="ui segments">
				<div class="ui segment">
					<h4>Редактиране на събитие</h4>
				</div>
				
				<div class="ui segment">
					<h3>{{ event.theme.title }}</h3>
					<el-form ref="form" :model="form" label-width="120px">
						

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

						<el-form-item label="Activity type">
							<el-checkbox-group v-model="form.type">
								<el-checkbox label="Online activities" name="type"></el-checkbox>
								<el-checkbox label="Promotion activities" name="type"></el-checkbox>
								<el-checkbox label="Offline activities" name="type"></el-checkbox>
								<el-checkbox label="Simple brand exposure" name="type"></el-checkbox>
							</el-checkbox-group>
						</el-form-item>
						<el-form-item label="Resources">
							<el-radio-group v-model="form.resource">
								<el-radio label="Sponsor"></el-radio>
								<el-radio label="Venue"></el-radio>
							</el-radio-group>
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
    export default {
    	data: function () {
    		return {
    			loading: true,
    			event: {},
    			themes: [],
    			teachers: [],
    			selectedTeachers: [],
    			date: [],
    			form: {
    				theme: '',
    				region: '',
    				date: '',
    				data1: '',
    				delivery: false,
    				type: [],
    				resource: '',
    				cover: 'https://picsum.photos/800/400/?image=293'
    			}
    		}
    	},

    	methods: {
    		save() {
    			console.log('save');
    			var vm = this;
    			axios.post('/dashboard/events', {
    				theme_id: vm.selectedTheme,
    				teachers: vm.selectedTeachers,
    				cover: 'https://picsum.photos/800/400/?image=120',
    				begin_at: vm.form.date[0],
    				end_at: vm.form.date[1],
    			})
    			.then(function (response) {
    				console.log(response);
    			})
    			.catch(function (error) {
    				console.log(error);
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
    }
</script>