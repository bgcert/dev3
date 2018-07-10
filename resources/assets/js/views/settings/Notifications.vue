<template>
	<div>
		<div v-if="notifications.length > 0">
			<div class="ui very relaxed divided list" v-for="notification in notifications">
				<div class="item">
					<img class="ui avatar image" src="https://picsum.photos/280/280/?image=123">
					<div class="content">
						<a class="header">Daniel Louise</a>
						<div class="description">{{ notification.data.message }}</div>
					</div>
				</div>
			</div>
		</div>
		<div v-else>
			<h4>Няма налични известия</h4>
		</div>
	</div>
</template>

<script>
    export default {
    	data: function () {
    		return {
    			notifications: []
    		}
    	},

    	methods: {

    	},

        mounted() {
            console.log('Notifications view mounted.');
        },

        created() {
        	var vm = this;
            var route = '/users/notifications';
        	axios.get(route).then(function (response) {
        		console.log(response.data);
        		vm.notifications = response.data;
        		// vm.loading = false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>