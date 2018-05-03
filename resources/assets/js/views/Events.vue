<template>
	<div>
		<div class="ui three stackable cards" v-loading.fullscreen="loading">
			<template v-for="event in events">
				<div class="card">
					<div class="image">
						<img :src="event.cover">
					</div>
					<div class="content">
						<p style="text-transform: uppercase;">
							{{ event.begin_at }}
						</p>
						<a :href="'/event/' + event.id" class="header">{{ event.theme.title }}</a>
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
    			events: '',
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
            var route = '/dashboard/events';
        	axios.get(route).then(function (response) {
        		console.log(response.data);
        		vm.events = response.data;
        		vm.loading = false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    }
</script>