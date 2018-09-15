<template>
	<div>
		<div class="ui segments">
			<div class="ui segment">
				<h4>Нова тема</h4>
			</div>
			
			<div class="ui segment">
				<el-form ref="form" :model="form" label-width="160px">

					<el-form-item label="Заглавие">
						<template v-if="errors.title" v-for="error in errors.title">
							 <el-alert type="error" :title="error"></el-alert>
						</template>
						<el-input v-model="form.title"></el-input>
					</el-form-item>

					<el-form-item label="Категория">
						<template v-if="errors.category_id" v-for="error in errors.category_id">
							 <el-alert type="error" :title="error"></el-alert>
						</template>
						<el-select v-model="form.category" placeholder="Изберете категория">
							<template v-for="category in categories">
								<el-option :label="category.name" :value="category.id"></el-option>	
							</template>
						</el-select>
					</el-form-item>

					<el-form-item label="Корица">
						<imageUpload :imageUrl="'/img/default_cover.png'"></imageUpload>
					</el-form-item>

					<el-form-item label="Кратко описание">
						<template v-if="errors.excerpt" v-for="error in errors.excerpt">
							 <el-alert type="error" :title="error"></el-alert>
						</template>
						<el-input type="textarea" :rows="3" v-model="form.excerpt"></el-input>
					</el-form-item>
					
					<el-form-item label="Съдържание">
						<template v-if="errors.body" v-for="error in errors.body">
							 <el-alert type="error" :title="error"></el-alert>
						</template>
						<el-input type="textarea" :rows="6" v-model="form.body"></el-input>
					</el-form-item>

					<el-form-item label="Учебни часове">
						<template v-if="errors.duration" v-for="error in errors.duration">
							 <el-alert type="error" :title="error"></el-alert>
						</template>
						<el-input v-model="form.duration" style="width: 100px;"></el-input>
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
	import { EventBus } from '../../app';
	import ImageUpload from '../../components/ImageUploadComponent.vue'
    export default {
    	components: {
			ImageUpload
		},
    	data: function () {
    		return {
    			loading: true,
    			categories: [],
    			form: {
    				title: '',
    				category: '',
    				body: '',
    				excerpt: '',
    				type: [],
    				duration: null
    			},
    			data: {},
    			errors: [],
    			coverErrors: []
    		}
    	},

    	methods: {
    		upload() {
    			let promise = new Promise((resolve, reject) => EventBus.$emit('upload', resolve, reject));
    			return promise;
    		},

    		async save() {
    			let vm = this;

				this.data = {
					title: this.form.title,
					body: this.form.body,
					excerpt: this.form.excerpt,
					duration: this.form.duration,
					category_id: this.form.category,
				}

				try {
					this.data.cover = await this.upload();
				} catch(e) {
					console.log(e);
				    this.data.cover = null;
				}

    			axios.post('/dashboard/themes', vm.data)
    			.then(function (response) {
    				vm.$message('Темата е добавена успешно.');
    				vm.$router.push('/themes');
    			})
    			.catch(function (error) {
    				vm.errors = error.response.data;
    			})
    		}
    	},

        mounted() {
            console.log('New theme view mounted.')
        },

        created() {
        	var vm = this;
            var route = '/dashboard/categories';
        	axios.get(route).then(function (response) {
        		vm.categories = response.data;
        		vm.loading = false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>