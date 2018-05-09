<template>
	<div>
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
						<div class="card">
							<div class="image">
								<img :src="theme.cover">
							</div>
							<div class="content">
								<router-link :to="'/themes/edit/' + theme.id" class="header">
									{{ theme.title }}
								</router-link>
							</div>
							<div class="extra content">
								<span class="right floated">
									<el-row>
										<a :href="'/theme/' + theme.id" class="mini ui positive icon button" target="_blank"><i class="eye icon"></i></a>
										<router-link :to="'/themes/edit/' + theme.id" class="item">
											<el-button type="warning" icon="el-icon-edit" size="mini"></el-button>
										</router-link>
										<router-link :to="'/themes/edit/' + theme.id" class="item">
											<el-button type="danger" icon="el-icon-delete" size="mini"></el-button>
										</router-link>
									</el-row>
								</span>
							</div>
						</div>
					</template>
				</div>
			</div>
		</div>
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