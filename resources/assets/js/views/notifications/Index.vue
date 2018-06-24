<template>
	<div class="ui segments">
		<div class="ui clearing segment">
			<h3 style="float: left;">Известия</h3>
		</div>

		<div class="ui segment">
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