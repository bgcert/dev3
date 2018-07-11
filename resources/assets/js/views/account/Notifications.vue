<template>
	<div>
		<div v-if="notifications.length > 0">
			<div class="ui very relaxed divided list">
				<div class="item" v-for="notification in notifications">
					<img class="ui avatar image" src="https://picsum.photos/280/280/?image=123">
					<div class="content">
						<a class="header">{{ notification.data.message }}</a>
						<div class="description">{{ notification.created_at }}</div>
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
        	axios.get('/users/notifications').then(function (response) {
        		vm.notifications = response.data;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>