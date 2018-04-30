<template>
	<div>
		<div class="ui three stackable cards">
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
	</div>
</template>

<script>
    export default {
    	data: function () {
    		return {
    			themes: ''
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
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    }
</script>