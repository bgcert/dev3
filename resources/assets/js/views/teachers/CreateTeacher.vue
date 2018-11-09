<template>
	<div class="segment">
		<h4>Нов лектор</h4>
		<el-form ref="form" :model="form" label-width="120px">
			<el-form-item label="Име">
				<template v-if="errors.name" v-for="error in errors.name">
					 <el-alert type="error" :title="error"></el-alert>
				</template>
				<el-input v-model="form.name"></el-input>
			</el-form-item>

			<el-form-item label="Снимка">
				<imageUpload :imageUrl="'/img/default_cover.png'"></imageUpload>
			</el-form-item>

			<el-form-item label="Съдържание">
				<template v-if="errors.details" v-for="error in errors.details">
					 <el-alert type="error" :title="error"></el-alert>
				</template>
				<el-input type="textarea" :rows="6" v-model="form.details"></el-input>
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
    			form: {
    				name: '',
    				details: '',
    			},
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
					name: this.form.name,
					details: this.form.details,
				}

				try {
					this.data.image = await this.upload();
				} catch(e) {
				    this.data.image = null;
				}

    			axios.post('/dashboard/teachers', vm.data)
    			.then(function (response) {
    				vm.$message('Лекторът е добавен успешно.');
    				vm.$router.push('/teachers');
    			})
    			.catch(function (error) {
    				vm.errors = error.response.data;
    			})
    		}
    	},

        mounted() {
            console.log('Create teacher view mounted.')
        },

        created() {

        }
    };
</script>