<template>
	<div>
		<div class="ui segments">
			<div class="ui segment">
				<h4>Нов лектор</h4>
			</div>
			
			<div class="ui segment">
				<el-form ref="form" :model="form" label-width="120px">
					<el-form-item label="Име">
						<el-input v-model="form.name"></el-input>
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
					<el-form-item label="Съдържание">
						<el-input type="textarea" :rows="12" v-model="form.details"></el-input>
					</el-form-item>
					<el-form-item>
						<div class="right floated">
							<div class="ui right floated primary button" @click="save">
					        	Запиши
					        </div>
							<router-link to="/teachers" class="item">
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
    			categories: [],
    			form: {
    				name: '',
    				details: '',
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
    			console.log('save');
    			var vm = this;
    			axios.post('/dashboard/themes', {
    				title: vm.form.title,
    				body: vm.form.body,
    				category_id: vm.form.category,
    				cover: vm.form.cover
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
    }
</script>