<template>
	<div class="grid grid-1-4 mtop">
		<div>
			<div class="vertical-menu">
				<router-link
					to="/contacts"
					class="item"
					:class="{ active: $route.path == '/contacts' }">
					Съобщения
				</router-link>
				<router-link
					to="/themes"
					class="item"
					:class="{ active: $route.path == '/themes' }">
					Теми
				</router-link>
				<router-link
					to="/teachers"
					class="item"
					:class="{ active: $route.path == '/teachers' }">
					Лектори
				</router-link>
				<router-link
					to="/events"
					class="item"
					:class="{ active: $route.path == '/events' }">
					Календар
				</router-link>
				<router-link v-if="venuePublish"
					to="/venues"
					class="item"
					:class="{ active: $route.path == '/venues' }">
					Зали
				</router-link>
				<router-link
					to="/orders"
					class="item"
					:class="{ active: $route.path == '/orders' }">
					Заявки
				</router-link>
				<router-link
					to="/profile"
					class="item"
					:class="{ active: $route.path == '/profile' }">
					Фирмени данни
				</router-link>
			</div>
		</div>
		<div>
			<!-- <keep-alive> -->
				<router-view></router-view>
			<!-- </keep-alive> -->
		</div>
	</div>
</template>

<script>
	import { EventBus } from '../app';
    export default {
    	props: ['event_publish', 'venue_publish'],
    	data: function () {
    		return {
    			eventPublish: this.event_publish,
    			venuePublish: this.venue_publish,
    			isCollapse: false
    		}
    	},

    	methods: {

    	},

        mounted() {
            console.log('Dashboard mounted.')
        },

        created() {
            
        }
    };
</script>

<style>
	.el-menu-vertical-demo:not(.el-menu--collapse) {
		min-height: 400px;
	}
</style>