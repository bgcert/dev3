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
						<input type="file" name="fileupload" @change="onFileSelected">
						<!-- Wrap the image or canvas element with a block element (container) -->
						<div>
							<img id="image" src="https://picsum.photos/800/400/?image=194">
						</div>
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

    			//$('#image').attr('src', URL.createObjectURL(event.target.files[0]));

				var $image = $('#image');

				$image.cropper({
					aspectRatio: 16 / 9,
					crop: function(event) {
						console.log(event.detail.x);
						console.log(event.detail.y);
						console.log(event.detail.width);
						console.log(event.detail.height);
						console.log(event.detail.rotate);
						console.log(event.detail.scaleX);
						console.log(event.detail.scaleY);
					}
				});

				// Get the Cropper.js instance after initialized
				var cropper = $image.data('cropper');

    		}
    	},

        mounted() {
            console.log('Edit theme view mounted.');
        },

        created() {
        	$.fn.cropper;
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
	/* Limit image width to avoid overflow the container */
	img {
	  max-width: 100%; /* This rule is very important, please do not ignore this! */
	}

</style>

