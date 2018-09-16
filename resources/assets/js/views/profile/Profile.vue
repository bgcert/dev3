<template>
	<div class="ui clearing segment" v-if="company.id">
		<form class="ui form">
			<div class="field" style="width: 300px;">
				<label>Име на организацията</label>
				<template v-if="errors.name" v-for="error in errors.name">
					 <el-alert type="error" :title="error"></el-alert>
				</template>
				<input type="text" v-model="company.name">
			</div>

			<div class="field" style="width: 400px;">
				<label>Адрес (URL) на профила в Seminari365</label>
				<template v-if="errors.slug" v-for="error in errors.slug">
					 <el-alert type="error" :title="error"></el-alert>
				</template>
				<div class="ui labeled right input">
					<div class="ui label">
						http://seminari365.com/c/
					</div>
					<input type="text" v-model="company.slug" placeholder="company.ltd">
				</div>
			</div>

			<div class="field">
				<label>Лого</label>
				<imageUpload :imageUrl="'https://d3cwccg7mi8onu.cloudfront.net/250x250/' + company.logo"></imageUpload>
			</div>

			<div class="field">
				<label>Описание</label>
				<template v-if="errors.description" v-for="error in errors.description">
					 <el-alert type="error" :title="error"></el-alert>
				</template>
				<textarea rows="6" v-model="company.description"></textarea>
			</div>

			<div class="equal width fields">
				<div class="field">
					<label>E-mail</label>
					<template v-if="errors.email" v-for="error in errors.email">
						 <el-alert type="error" :title="error"></el-alert>
					</template>
					<input type="text" v-model="company.email">
				</div>

				<div class="field">
					<label>Телефон</label>
					<template v-if="errors.phone" v-for="error in errors.phone">
						 <el-alert type="error" :title="error"></el-alert>
					</template>
					<input type="text" v-model="company.phone">
				</div>
			</div>
			
			<div class="field">
				<label>Адрес</label>
				<template v-if="errors.address" v-for="error in errors.address">
					 <el-alert type="error" :title="error"></el-alert>
				</template>
				<textarea rows="2" v-model="company.address"></textarea>
			</div>

			<div class="field">
				<button class="ui labeled icon button" @click.prevent="save" style="float: right;"><i class="icon save"></i> Запиши</button>
			</div>
			
		</form>

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
    			company: [],
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

    			let data = {
					name: this.company.name,
					slug: this.company.slug,
					address: this.company.address,
					description: this.company.description,
					email: this.company.email,
					phone: this.company.phone,
				}

				try {
					data.logo = await this.upload();
				} catch(e) {
				    data.logo = null;
				}

				let route = '/dashboard/save/company/data';

    			axios.patch(route, data)
    			.then(function (response) {
    				vm.$message('Данните са редактирани успешно.');
    				location.reload();
    			})
    			.catch(function (error) {
    				vm.errors = error.response.data;
    			})
    		}
    	},

        mounted() {
            console.log('Settings mounted.')
        },

        created() {
            var vm = this;
            var route = '/dashboard/load/company';
        	axios.get(route).then(function (response) {
        		vm.company = response.data;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>