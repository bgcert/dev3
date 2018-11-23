<template>
	<div class="notifications">
		<template v-if="notifications.length > 0">
			<ul>
				<li v-for="notification in notifications">
					<template v-if="notification.feed_notifiable_type == 'App\\Order'">
						<a href="/dashboard#/orders" class="item" :class="{ unread: notification.read_at == null }">
							<div class="icon">
								<i class="fas fa-user"></i>	
							</div>
							<div class="content">
								<div class="date">{{ notification.created_at }}</div>
								Нова заявка за {{ notification.data }}
							</div>
						</a>
					</template>
					<template v-else>
						<a href="/dashboard#/contacts" class="item">
							<div class="icon">
								<i class="far fa-envelope"></i>
							</div>
							<div class="content">
								<div class="date">{{ notifications[0].created_at }}</div>
								Имате запитване относно {{ notifications[0].data }}
							</div>
						</a>
					</template>
					
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