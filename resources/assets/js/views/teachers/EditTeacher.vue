<template>
	<div class="segment">
		<h4>Редактиране на лектор</h4>
		<div v-if="!loading">
			<el-form ref="form" label-width="120px">
				<el-form-item label="Име">
					<template v-if="errors.name" v-for="error in errors.name">
						 <el-alert type="error" :title="error"></el-alert>
					</template>
					<el-input v-model="teacher.name"></el-input>
				</el-form-item>

				<el-form-item label="Снимка">
					<imageUpload :imageUrl="'https://d3cwccg7mi8onu.cloudfront.net/250x150/' + teacher.image"></imageUpload>
				</el-form-item>

				<el-form-item label="Съдържание">
					<template v-if="errors.details" v-for="error in errors.details">
						 <el-alert type="error" :title="error"></el-alert>
					</template>
					<el-input type="textarea" :rows="6" v-model="teacher.details"></el-input>
				</el-form-item>
				<div class="field right">
					<div class="btn blue" @click="save">
			        	Запиши
			        </div>
					<router-link to="/teachers" class="btn basic">
						Откажи
					</router-link>	
				</div>
			</el-form>
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
    			teacher: [],
    			data: {},
    			errors: []
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
					name: this.teacher.name,
					details: this.teacher.details,
				}

				try {
					this.data.image = await this.upload();
				} catch(e) {
				    this.data.image = null;
				}

				let route = '/dashboard/teachers/' + this.$route.params.id;

    			axios.patch(route, vm.data)
    			.then(function (response) {
    				vm.$message('Лекторът е редактиран успешно.');
    				vm.$router.push('/teachers');
    			})
    			.catch(function (error) {
    				vm.errors = error.response.data;
    			})
    		}
    	},

        mounted() {
            console.log('Edit teacher view mounted.')
        },

        created() {
        	var vm = this;
            var route = '/dashboard/teachers/' +  this.$route.params.id + '/edit';
        	axios.get(route).then(function (response) {
        		console.log(response.data);
        		vm.teacher = response.data;
        		//vm.categories = response.data[1];
        		vm.loading = false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>