<template>
	<div>
		<div class="ui segments">
			<div class="ui segment">
				<h4>Редактиране на тема</h4>
			</div>
			
			<div class="ui segment">
				<el-form ref="form" :model="form" label-width="120px">
					<el-form-item label="Заглавие">
						<el-input v-model="theme.title"></el-input>
					</el-form-item>

					<el-form-item label="Категория">
						<el-select v-model="theme.category_id" placeholder="Изберете категория">
							<template v-for="category in categories">
								<el-option :label="category.name" :value="category.id"></el-option>	
							</template>
						</el-select>
					</el-form-item>
					
					<el-form-item label="Съдържание">
						<el-input type="textarea" :rows="12" v-model="theme.body"></el-input>
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

				<h3>File upload</h3>
				<hr>

				<input type="file" @change="onFileChange">

				<div id="canvas">
					<img v-if="url" id="image" :src="url">
				</div>

			</div>
		</div>
	</div>
</template>

<script>
    export default {
    	data: function () {
    		return {
    			url: null,
    			dialogVisible: false,
    			loading: true,
    			categories: [],
    			theme: [],
    			form: {
    				title: '',
    				category: '',
    				body: '',
    				type: [],
    				cover: 'https://picsum.photos/800/400/?image=293'
    			}
    		}
    	},

    	methods: {
    		save() {
    			console.log('save');
    			var vm = this;
    			let route = '/dashboard/themes/' + this.$route.params.id;
    			axios.put(route, {
    				title: vm.theme.title,
    				body: vm.theme.body,
    				category_id: vm.theme.category_id,
    				cover: vm.form.cover
    			})
    			.then(function (response) {
    				console.log(response.data);
    				vm.$message('Темата е редактирана успешно.');
    				vm.$router.push('/themes');
    			})
    			.catch(function (error) {
    				console.log(error);
    			});
    		},

    		onFileChange(e)
    		{
				const file = e.target.files[0];
    			this.url = URL.createObjectURL(file);
    		}
    	},

        mounted() {
            console.log('Edit theme view mounted.');
        },

        created() {
        	var vm = this;
            var route = '/dashboard/themes/' + this.$route.params.id + '/edit';
        	axios.get(route).then(function (response) {
        		console.log(response.data);
        		vm.theme = response.data[0];
        		vm.categories = response.data[1];
        		vm.loading = false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>

<style>
	#image img {
		max-width: 400px;
	}

</style>

