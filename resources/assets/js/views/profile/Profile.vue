<template>
	<div class="card" v-if="company.id">

		<div class="card-header">
			Фирмени данни
		</div>

		<div class="card-body">
			<div class="form-group">
				<label>Име на организацията</label>
				<input type="text" name="name" class="form-control" :class="{ 'is-invalid': errors.name }" v-model="company.name" autofocus required>
				<div class="invalid-feedback" v-if="errors.name">
					{{ errors.name[0] }}
				</div>
			</div>

			<div class="form-group">
				<label>Адрес на профила</label>
				<div class="input-group">
					<div class="input-group-prepend">
						<div class="input-group-text">seminari365.com/c/</div>
					</div>
					<input type="text" class="form-control" :class="{ 'is-invalid': errors.slug }" v-model="company.slug" placeholder="company.ltd" required>
					<div class="invalid-feedback" v-if="errors.slug">
						{{ errors.slug[0] }}
					</div>
				</div>
				<small class="form-text text-muted">Пример: abcltd или abc.ltd</small>
			</div>

			<div class="form-group">
				<label>Лого</label>
				<imageUpload :imageUrl="'https://d3cwccg7mi8onu.cloudfront.net/250x250/' + company.logo"></imageUpload>
			</div>

			<div class="form-group">
				<label>Описание</label>
				<textarea class="form-control" :class="{ 'is-invalid': errors.description }" rows="6" v-model="company.description"></textarea>
				<div class="invalid-feedback" v-if="errors.description">
					{{ errors.description[0] }}
				</div>
			</div>

			<div class="form-group">
				<label>E-mail</label>
				<input type="email" name="email" class="form-control" :class="{ 'is-invalid': errors.email }" v-model="company.email">
				<div class="invalid-feedback" v-if="errors.email">
					{{ errors.email[0] }}
				</div>
			</div>

			<div class="form-group">
				<label>Телефон</label>
				<input type="text" name="phone" class="form-control" :class="{ 'is-invalid': errors.phone }" v-model="company.phone">
				<div class="invalid-feedback" v-if="errors.phone">
					{{ errors.phone[0] }}
				</div>
			</div>

			<div class="form-group">
				<label>Адрес</label>
				<input type="text" name="address" class="form-control" :class="{ 'is-invalid': errors.address }" v-model="company.address">
				<div class="invalid-feedback" v-if="errors.address">
					{{ errors.address[0] }}
				</div>
			</div>

			<div class="form-group">
				<div class="text-right">
					<button class="btn btn-primary" @click.prevent="save"><i class="far fa-save"></i> Запиши</button>
				</div>
			</div>
		</div>

		<!-- <form> -->
			<!-- <div class="field">
				<label>Име на организацията</label>
				<template v-if="errors.name" v-for="error in errors.name">
					 <el-alert type="error" :title="error"></el-alert>
				</template>
				<input type="text" v-model="company.name">
			</div> -->

			<!-- <div class="field">
				<template v-if="errors.slug" v-for="error in errors.slug">
					 <el-alert type="error" :title="error"></el-alert>
				</template>
				<label>Адрес (URL) на профила в Seminari365</label>
				<span class="label input">
					http://seminari365.com/c/
				</span>
				<input type="text" v-model="company.slug" placeholder="company.ltd" class="labeled">
			</div>
			<div class="field">
				<div class="message orange">Пример: abcltd или abc.ltd</div>	
			</div> -->

			<!-- <div class="field">
				<label>Лого</label>
				<imageUpload :imageUrl="'https://d3cwccg7mi8onu.cloudfront.net/250x250/' + company.logo"></imageUpload>
			</div> -->

			<!-- <div class="field">
				<label>Описание</label>
				<template v-if="errors.description" v-for="error in errors.description">
					 <el-alert type="error" :title="error"></el-alert>
				</template>
				<textarea rows="6" v-model="company.description"></textarea>
			</div> -->

			<!-- <div class="equal width fields">
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

			<div class="field right">
				<button class="btn blue" @click.prevent="save"><i class="icon save"></i> Запиши</button>
			</div>
			
		</form> -->

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