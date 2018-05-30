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

					<el-form-item label="Корица">
						<img class="ui medium bordered image" :src="theme.cover">
						<button class="ui basic button" @click.prevent="toggleShow"><i class="icon cloud upload"></i> Смени корицата</button>
						<my-upload field="img"
					        @crop-success="cropSuccess"
					        v-model="show"
							:width="357"
							:height="179"
							langType="bg"
							img-format="png"
							:noCircle="true">
						</my-upload>
						<img :src="imgDataUrl">

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

			</div>
		</div>
	</div>
</template>
<script>
    export default {
    	data: function () {
    		return {
    			show: false,
				params: {
					token: '123456798',
					name: 'avatar'
				},
				headers: {
					smail: '*_~'
				},
				imgDataUrl: '', // the datebase64 url of created image
    			loading: true,
    			selectedFile: null,
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

    		toggleShow() {
				this.show = !this.show;
			},
            /**
			 * crop success
			 *
			 * [param] imgDataUrl
			 * [param] field
			 */
			cropSuccess(imgDataUrl, field){
				console.log('-------- crop success --------');
				var vm = this;
				let route = '/dashboard/themes/set/cover';
				axios.post(route, {
					cover: imgDataUrl
    			})
    			.then(function (response) {
    				vm.$message('Корицата е сменена');
    			})
    			.catch(function (error) {
    				console.log(error);
    			});
				this.theme.cover = imgDataUrl;
			},
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
	
</style>

