<template>
	<span class="item notification-icon">
		<el-popover
			placement="bottom-end"
			width="400"
			trigger="click">

			<div class="ui relaxed divided list">
				<div class="item">
					<i class="large github middle aligned icon"></i>
					<div class="content">
						<a class="header">Semantic-Org/Semantic-UI</a>
						<div class="description">Updated 10 mins ago</div>
					</div>
				</div>
				<div class="item">
					<i class="large github middle aligned icon"></i>
					<div class="content">
						<a class="header">Semantic-Org/Semantic-UI-Docs</a>
						<div class="description">Updated 22 mins ago</div>
					</div>
				</div>
				<div class="item">
					<i class="large github middle aligned icon"></i>
					<div class="content">
						<a class="header">Semantic-Org/Semantic-UI-Meteor</a>
						<div class="description">Updated 34 mins ago</div>
					</div>
				</div>
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
    			notifications: [],
    			notificationsCount: 0
    		}
    	},

    	methods: {
    		
    	},

        mounted() {
            console.log('Notifications component mounted.');

            Echo.private('notifications.' + this.user_id)
                	.listen('NewNotification', (e) => {
                		this.notificationsCount ++;

                		// play sound
						ion.sound.play("button_tiny");
                		console.log('new notification');
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