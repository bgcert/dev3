<template>
	<div>
		<!-- <el-dialog
			title="Tips"
			:visible.sync="dialogVisible"
			width="30%"
			:before-close="handleDelete">
			<span>This is a message</span>
			<span slot="footer" class="dialog-footer">
				<el-button @click="dialogVisible = false">Не</el-button>
				<el-button type="primary" @click="dialogVisible = false">Да</el-button>
			</span>
		</el-dialog> -->

		<div class="ui segments">
			<div class="ui clearing segment">
				<h3 style="float: left;">Теми</h3>
				<router-link to="/themes/create" class="item" style="float: right;">
					<button class="ui tiny basic button">
						<i class="plus icon"></i>
						Добави тема
					</button>
				</router-link>
			</div>

			<div class="ui segment" v-loading="loading" style="min-height: 200px;">

				<div class="ui three stackable cards">
					<template v-for="theme in themes">
						<CardDashboard
							:image="theme.cover"
							:title="theme.title"
							:edit_link="'/themes/edit/' + theme.id"
							v-on:show="handleShow(theme.id)"
							v-on:delete="handleDelete(theme.id)"
							>
						</CardDashboard>
					</template>
				</div>

			</div>
		</div>
	</div>
</template>

<script>
	import CardDashboard from '../../components/CardDashboardComponent.vue'
    export default {
    	components: {
			CardDashboard
		},
    	data: function () {
    		return {
    			dialogVisible: false,
    			themes: '',
    			loading: true
    		}
    	},

    	methods: {
    		handleDelete(id) {
    			this.$confirm('Сигурни ли сте, че желаете да изтриете тази тема?')
	    			.then(_ => {
	    				console.log(id);
	    				done();
	    			})
	    			.catch(_ => {});
    		},

    		handleShow(id) {
    			window.open('/event/' + id,'_blank');
    		}
    	},

        mounted() {
            console.log('theme box Component mounted.')
        },

        created() {
        	var vm = this;
            var route = '/dashboard/themes';
        	axios.get(route).then(function (response) {
        		console.log(response.data);
        		vm.themes = response.data;
        		vm.loading = false;
			})
			.catch(function (error) {
				console.log(error);
			});


        }
    };
</script>