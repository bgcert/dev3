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
						<!-- <div>
							<img id="image" src="https://picsum.photos/800/400/?image=194">
						</div> -->

						<vueCropper
							ref="cropper2"
							:img="example2.img"
							:outputSize="example2.size"
							:outputType="example2.outputType"
							:info="example2.info"
							:canScale="example2.canScale"
							:autoCrop="example2.autoCrop"
							:autoCropWidth="example2.autoCropWidth"
							:autoCropHeight="example2.autoCropHeight"
							:fixed="example2.fixed"
							:fixedNumber="example2.fixedNumber"
						></vueCropper>

						


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
    			example2: {
					img: 'http://ofyaji162.bkt.clouddn.com/bg1.jpg',
					info: true,
					size: 1,
					outputType: 'jpeg',
					canScale: false,
					autoCrop: true,
					// 只有自动截图开启 宽度高度才生效
					autoCropWidth: 300,
					autoCropHeight: 250,
					// 开启宽度和高度比例
					fixed: true,
					fixedNumber: [4, 3]
				},
    			img: 'https://picsum.photos/800/400/?image=194',
    			size: 1,
    			type: 'png',
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
	/* Limit image width to avoid overflow the container */
	img {
	  max-width: 100%;
	  height: 200px;
	}
</style>

