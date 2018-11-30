<template>
	<div class="notifications">
		<template v-if="notifications.length > 0">
			<ul>
				<li v-for="notification in notifications">
					<a href="#" class="item" @click.prevent="openNotification(notification)">
						<template v-if="notification.feed_notifiable_type == 'App\\Order'">
							<div class="icon">
								<i class="fas fa-user"></i>	
							</div>
							<div class="content">
								<div class="date">{{ notification.created_at }}</div>
								Нова заявка за {{ notification.data }}
							</div>
						</template>
						<template v-else>
							
								<div class="icon">
									<i class="far fa-envelope"></i>
								</div>
								<div class="content">
									<div class="date">{{ notifications[0].created_at }}</div>
									Имате запитване относно {{ notifications[0].data }}
								</div>
						</template>
					</a>
				</li>
			</ul>
		</template>
		<template v-else>
			<h5>Няма налични известия</h5>
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
    		// openNotification(id) {
    		// 	console.log(id);
    		// 	this.markAsRead(id);
    		// },

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