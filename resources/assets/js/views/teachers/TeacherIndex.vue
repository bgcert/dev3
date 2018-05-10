<template>
	<div>
		<div class="ui segments">
			<div class="ui clearing segment">
				<h3 style="float: left;">Лектори</h3>
				<router-link to="/teachers/create" class="item" style="float: right;">
					<button class="ui tiny basic button">
						<i class="plus icon"></i>
						Добави лектор
					</button>
				</router-link>
			</div>

			<div class="ui segment" v-loading="loading" style="min-height: 200px;">
				<div class="ui three stackable cards">
					<template v-for="teacher in teachers">
						<div class="card">
							<div class="image">
								<img :src="teacher.image">
							</div>
							<div class="content">
								<a :href="'/teacher/' + teacher.id" class="header">{{ teacher.name }}</a>
							</div>
							<div class="extra content">
								<span class="right floated">
									<el-row>
										<el-button type="success" icon="el-icon-view" size="mini"></el-button>
										<router-link :to="'/teachers/edit/' + teacher.id" class="item">
											<el-button type="warning" icon="el-icon-edit" size="mini"></el-button>
										</router-link>
										<el-button type="danger" icon="el-icon-delete" size="mini"></el-button>
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
    			teachers: '',
    			loading: true
    		}
    	},

    	methods: {

    	},

        mounted() {
            console.log('Teacher index view Component mounted.')
        },

        created() {
        	var vm = this;
            var route = '/dashboard/teachers';
        	axios.get(route).then(function (response) {
        		console.log(response.data);
        		vm.teachers = response.data;
        		vm.loading = false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    }
</script>