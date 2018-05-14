<template>
	<div>
		<div class="ui segments">
			<div class="ui secondary segment">
				<h4>Редактиране на лектор</h4>
			</div>
			
			<div class="ui segment">
				<el-form ref="form" :model="form" label-width="120px">
					<el-form-item label="Име">
						<el-input v-model="teacher.name"></el-input>
					</el-form-item>

					<el-form-item label="Съдържание">
						<el-input type="textarea" :rows="12" v-model="teacher.details"></el-input>
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
    			teacher: [],
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
    			var vm = this;
    			let route = '/dashboard/teachers/' + this.$route.params.id;
    			axios.patch(route, {
    				name: vm.teacher.name,
    				details: vm.teacher.details,
    				image: 'https://picsum.photos/400/400/?image=276'
    			})
    			.then(function (response) {
    				console.log(response);
    				vm.$message('Лекторът е редактиран успешно.');
    				vm.$router.push('/teachers');
    			})
    			.catch(function (error) {
    				console.log(error);
    			});
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
    }
</script>