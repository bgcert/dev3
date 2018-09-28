<template>
	<span class="item notification-icon" @click="listNotifications" v-if="!user.token">
		<el-popover
			placement="bottom-end"
			trigger="click">
			<div v-loading="loading" >
				<div class="ui middle aligned divided list" style="max-width: 300px;">
					<div class="item" :class="{ unread: notification.read_at == null }" v-for="notification in notifications">
						<i class="info circle middle aligned icon"></i>
						<div class="content">
							<a href="/users/settings#/notifications" class="header" @click.prevent="markAsRead(notification.id)">{{ notification.data.message }}</a>
							<div class="description">{{ notification.created_at }}</div>
						</div>
					</div>
				</div>
				<a href="/users/settings#/notifications" class="ui tiny fluid button">Всички известия</a>
			</div>
			
			<span slot="reference">
				<div style="position: relative;">
					<i class="bell icon" :class="{ 'orange': this.notificationsCount > 0, outline: this.notificationsCount == 0 }"></i>
					<span class="notification-label" v-if="notificationsCount > 0">{{ notificationsCount }}</span>
				</div>
			</span>
		</el-popover>
	</span>
</template>

<script>
	import { EventBus } from '../app';
    export default {
    	props: ['user_id'],
    	
    	data: function () {
    		return {
    			user: window.user,
    			loading: false,
    			notifications: [],
    			notificationsCount: 0
    		}
    	},

    	methods: {
    		listNotifications() {
    			this.loading = true;
    			var vm = this;
	        	axios.get('/users/notifications').then(function (response) {
	        		vm.notifications = response.data;
	        		vm.loading = false;
				})
				.catch(function (error) {
					console.log(error);
				});
    		},
    		markAsRead(id) {
    			var vm = this;
    			let route = '/users/notifications/' + id;
	        	axios.get(route).then(function (response) {
	        		window.location.href = '/users/settings#/notifications';
				})
				.catch(function (error) {
					console.log(error);
				});
    		}
    	},

        mounted() {
            console.log('Notifications component mounted.');

			var vm = this;
        	axios.get('/users/notifications/check').then(function (response) {
        		vm.notificationsCount = response.data;
			})
			.catch(function (error) {
				console.log(error);
			});

            Echo.private('notifications.' + this.user_id)
                	.listen('NewNotification', (e) => {
                		this.notificationsCount ++;

                		// play sound
						ion.sound.play("button_tiny");
                });

			// init bunch of sounds
			ion.sound({
				sounds: [
					{name: "button_tiny"},
				],

			    // main config
			    path: "/sounds/",
			    preload: true,
			    multiplay: true,
			    volume: 0.9
			});
        }
    };
</script>

<style>
	.unread {
		background-color: #f1f1f1;
	}

	.notification-icon {
		cursor: pointer;
		/*background-color: #fdd8ab !important;*/
	}

	.notification-label {
		position: absolute;
		top: -8px;
		left: 14px;
		font-size: 8px;
		background-color: #f2711c;
		padding: 2px;
		border-radius: 2px;
		color: white;
		opacity: 0.7;
		box-shadow: 1px 1px 0px 0px rgba(0,0,0,0.59);
	}
</style>