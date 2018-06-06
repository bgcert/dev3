<template>
	<div>
		<div class="ui segments">
			<div class="ui segment">
				<h4>Нова тема</h4>
			</div>
			
			<div class="ui segment">
				<el-form ref="form" :model="form" label-width="120px">
					<el-form-item label="Заглавие">
						<el-input v-model="form.title"></el-input>
					</el-form-item>

					<el-form-item label="Категория">
						<el-select v-model="form.category" placeholder="Изберете категория">
							<template v-for="category in categories">
								<el-option :label="category.name" :value="category.id"></el-option>	
							</template>
						</el-select>
					</el-form-item>
					
					<el-form-item label="Instant delivery">
						<el-switch v-model="form.delivery"></el-switch>
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

					<el-form-item label="Корица">
						<imageUpload
							canvasWidth="357"
							canvasHeight="178"
							>
						</imageUpload>
					</el-form-item>
					

					<el-form-item label="Съдържание">
						<el-input type="textarea" :rows="12" v-model="form.body"></el-input>
					</el-form-item>
					<el-form-item>
						<div class="right floated">
							<div class="ui right floated primary button" @click="save">
					        	Запиши
					        </div>
							<router-link to="/themes" class="item">
								<div class="ui right floated basic button">
						        	Откажи
						        </div>
							</router-link>	
						</div>
					</el-form-item>
				</el-form>
				<button class="ui basic button" @click="save">test</button>
			</div>
		</div>
	</div>
</template>

<script>
	import { EventBus } from '../../app';
    export default {
    	data: function () {
    		return {
    			loading: true,
    			categories: [],
    			form: {
    				title: '',
    				category: '',
    				body: '',
    				region: '',
    				date1: '',
    				date2: '',
    				delivery: false,
    				type: [],
    				resource: '',
    				cover: 'https://picsum.photos/800/400/?image=293'
    			}
    		}
    	},

    	methods: {
    		save() {
    			let vm = this;
    			let upload = new Promise((resolve, reject) => EventBus.$emit('imageSave', resolve, reject));

				upload.then((data) => {
					this.postTheme(data);
					console.log(data); // data is the function returned from the child component (imageUpload)	
				}, (error) => {
					console.log('Promise rejected.');
					vm.$message('Невалидно изображение');
				});
    		},

    		postTheme(data) {
    			var vm = this;
    			axios.post('/dashboard/themes', {
    				title: vm.form.title,
    				body: vm.form.body,
    				category_id: vm.form.category,
    				position: data[0],
    				cover: data[1],
    				filename: data[2],
    				width: 357
    			})
    			.then(function (response) {
    				console.log(response);
    				vm.$message('Темата е добавена успешно.');
    				vm.$router.push('/themes');
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
            var route = '/dashboard/categories';
        	axios.get(route).then(function (response) {
        		console.log(response.data);
        		vm.categories = response.data;
        		vm.loading = false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>