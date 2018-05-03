<template>
	<div>
		<h3>Нова тема</h3>
		<el-form ref="form" :model="form" label-width="120px">
			<el-form-item label="Заглавие">
				<el-input v-model="form.name"></el-input>
			</el-form-item>
			<el-form-item label="Категория">
				<el-select v-model="form.region" placeholder="please select your zone">
					<el-option label="Zone one" value="shanghai"></el-option>
					<el-option label="Zone two" value="beijing"></el-option>
				</el-select>
			</el-form-item>
			<el-form-item label="Instant delivery">
				<el-switch v-model="form.delivery"></el-switch>
			</el-form-item>
			<el-form-item label="Activity type">
				<el-checkbox-group v-model="form.type">
					<el-checkbox label="Online activities" name="type"></el-checkbox>
					<el-checkbox label="Promotion activities" name="type"></el-checkbox>
					<el-checkbox label="Offline activities" name="type"></el-checkbox>
					<el-checkbox label="Simple brand exposure" name="type"></el-checkbox>
				</el-checkbox-group>
			</el-form-item>
			<el-form-item label="Resources">
				<el-radio-group v-model="form.resource">
					<el-radio label="Sponsor"></el-radio>
					<el-radio label="Venue"></el-radio>
				</el-radio-group>
			</el-form-item>
			<el-form-item label="Съдържание">
				<el-input type="textarea" v-model="form.desc"></el-input>
			</el-form-item>
			<el-form-item>
				<el-button type="primary">Добави</el-button>
				<el-button>Откажи</el-button>
			</el-form-item>
		</el-form>
	</div>
</template>

<script>
    export default {
    	data: function () {
    		return {
    			loading: true,
    			form: {
    				name: '',
    				region: '',
    				date1: '',
    				date2: '',
    				delivery: false,
    				type: [],
    				resource: '',
    				desc: ''
    			}
    		}
    	},

    	methods: {

    	},

        mounted() {
            console.log('New theme view mounted.')
        },

        created() {
   //      	var vm = this;
   //          var route = '/dashboard/themes';
   //      	axios.get(route).then(function (response) {
   //      		console.log(response.data);
   //      		vm.themes = response.data;
   //      		vm.loading = false;
			// })
			// .catch(function (error) {
			// 	console.log(error);
			// });
        }
    }
</script>