<template>
	<div>
		<el-row>
			<router-link to="/themes/create" class="item">
				<el-button> Добави тема</el-button>
			</router-link>
  		</el-row>
  		<el-row>
			<div class="ui three stackable cards" v-loading.fullscreen="loading">
				<template v-for="theme in themes">
					<div class="card">
						<div class="image">
							<img :src="theme.cover">
						</div>
						<div class="content">
							<a :href="'/theme/' + theme.id" class="header">{{ theme.title }}</a>
						</div>
						<div class="extra content">
							<span class="right floated">
								<el-row>
									<el-button type="success" icon="el-icon-view" size="mini"></el-button>
									<el-button type="warning" icon="el-icon-edit" size="mini"></el-button>
									<el-button type="danger" icon="el-icon-delete" size="mini"></el-button>
								</el-row>
							</span>
						</div>
					</div>
				</template>
			</div>
		</el-row>
	</div>
</template>

<script>
    export default {
    	data: function () {
    		return {
    			themes: '',
    			loading: true
    		}
    	},

    	methods: {

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
    }
</script>