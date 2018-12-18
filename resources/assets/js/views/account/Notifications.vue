<template>
	<div class="notifications">
		<template v-if="notifications.length > 0">
			<ul class="list-group col-6">
				<a
					class="list-group-item list-group-item-action d-flex align-items-center"
					href="#" v-for="notification in notifications"
					:class="{ 'active': notification.read_at == null }"
					@click.prevent="openNotification(notification)">

					<template v-if="notification.feed_notifiable_type == 'App\\Order'">
						<i class="fas fa-user mr-3"></i>
						<div>
							<div>Имате заявка за {{ notification.data }}</div>
							<small>{{ notification.created_at }}</small>
						</div>
					</template>
					<template v-else>
						<i class="far fa-envelope mr-3"></i>
						<div>
							<div>Имате запитване за {{ notification.data }}</div>
							<small>{{ notification.created_at }}</small>
						</div>
					</template>
				</a>
			</ul>
		</template>
		<template v-else>
			<h5>Нямате налични известия</h5>
		</template>
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

    		openNotification(item) {
    			let vm = this;
    			let route = '/users/notifications/' + item.id;
	        	axios.get(route).then(function (response) {
	        		console.log(response.data);

	        		// Needs to be improved!
	        		if (item.feed_notifiable_type == 'App\\Order') {
						window.location.href = '/dashboard#/orders';
	    			} else {
	    				window.location.href = '/dashboard#/contacts';
	    			}
				})
				.catch(function (error) {
					console.log(error);
				});
    		}
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