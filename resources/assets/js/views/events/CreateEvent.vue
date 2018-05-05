<template>
	<div>
		<div class="ui segments">
			<div class="ui segment">
				<h4>Ново събитие</h4>
			</div>
			
			<div class="ui segment">
				<el-form ref="form" :model="form" label-width="120px">
					<el-form-item label="Категория">
						<el-select v-model="form.theme" placeholder="Изберете тема">
							<template v-for="theme in themes">
								<el-option :label="theme.title" :value="theme.id"></el-option>	
							</template>
						</el-select>
					</el-form-item>

					<el-form-item label="Instant delivery">
						<el-switch v-model="form.delivery"></el-switch>
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
	</div>
</template>

<script>
    export default {
    	data: function () {
    		return {
    			loading: true,
    			themes: [],
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
    				theme_id: vm.form.theme,
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
            console.log('New theme view mounted.')
        },

        created() {
        	var vm = this;
            var route = '/dashboard/themes';
        	axios.get(route).then(function (response) {
        		console.log(response.data);
        		vm.themes = response.data;
        		vm.loading = false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    }
</script>