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
						<button class="ui basic button" @click="toggleShow"><i class="icon cloud upload"></i> Смени корицата</button>
						<my-upload field="img"
					        @crop-success="cropSuccess"
					        @crop-upload-success="cropUploadSuccess"
					        @crop-upload-fail="cropUploadFail"
					        v-model="show"
							:width="357"
							:height="179"
							url="/upload"
							:params="params"
							:headers="headers"
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
				bg: {
			        hint: 'Натиснете тук',
			        loading: 'Качване…',
			        noSupported: 'Браузерът не се поддържа.',
			        success: 'Upload success',
			        fail: 'Upload failed',
			        preview: 'Преглед',
			        btn: {
			            off: 'Cancel',
			            close: 'Затвори',
			            back: 'Назад',
			            save: 'Запиши'
			        },
			        error: {
			            onlyImg: 'Image only',
			            outOfSize: 'Image exceeds size limit: ',
			            lowestPx: 'Image\'s size is too low. Expected at least: '
			        }
			    },
    			show: false,
				params: {
					token: '123456798',
					name: 'avatar'
				},
				headers: {
					smail: '*_~'
				},
				imgDataUrl: '', // the datebase64 url of created image
    			img: 'https://picsum.photos/800/400/?image=194',
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

    		onFileSelected(event)
    		{
    			$('#image').attr('src', URL.createObjectURL(event.target.files[0]));
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
				this.imgDataUrl = imgDataUrl;
			},
			/**
			 * upload success
			 *
			 * [param] jsonData  server api return data, already json encode
			 * [param] field
			 */
			cropUploadSuccess(jsonData, field){
				console.log('-------- upload success --------');
				console.log(jsonData);
				console.log('field: ' + field);
			},
			/**
			 * upload fail
			 *
			 * [param] status    server api return error status, like 500
			 * [param] field
			 */
			cropUploadFail(status, field){
				console.log('-------- upload fail --------');
				console.log(status);
				console.log('field: ' + field);
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
	
</style>

