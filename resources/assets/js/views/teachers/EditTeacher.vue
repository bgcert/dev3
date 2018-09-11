<template>
	<div>
		<div class="ui segments">
			<div class="ui secondary segment">
				<h4>Редактиране на лектор</h4>
			</div>
			
			<div class="ui segment" v-if="!loading">
				<el-form ref="form" label-width="120px">
					<el-form-item label="Име">
						<el-input v-model="teacher.name"></el-input>
					</el-form-item>

					<el-form-item label="Снимка">
						<imageUpload
							:imageUrl="'https://d3cwccg7mi8onu.cloudfront.net/fit-in/' + teacher.image">
						</imageUpload>
					</el-form-item>

					<el-form-item label="Съдържание">
						<el-input type="textarea" :rows="6" v-model="teacher.details"></el-input>
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
    		}
    	},

    	methods: {
    		upload() {
    			let promise = new Promise((resolve, reject) => EventBus.$emit('upload', resolve, reject));
    			return promise;
    		},
    		
    		async save() {
    			let vm = this;
				let data = {
					name: this.teacher.name,
					details: this.teacher.details,
				}

				let image = await this.upload();

				if (image) {
					data.image = image;
				}

				let route = '/dashboard/teachers/' + this.$route.params.id;

    			axios.patch(route, data)
    			.then(function (response) {
    				vm.$message('Лекторът е редактиран успешно.');
    				vm.$router.push('/teachers');
    			})
    			.catch(function (error) {
    				console.log(error);
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