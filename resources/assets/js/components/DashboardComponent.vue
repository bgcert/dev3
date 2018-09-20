<template>
	<div>
		<div class="ui grid mt-20">
			<div class="four wide column">
				<div class="ui fluid vertical pointing menu">
					<router-link
						to="/inbox"
						class="item"
						:class="{ active: $route.path == '/inbox' }">
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
			<div class="twelve wide column">
				<!-- <keep-alive> -->
					<router-view></router-view>
				<!-- </keep-alive> -->
			</div>
		</div>
	</div>
</template>

<script>
	import { EventBus } from '../app';
    export default {

    	data: function () {
    		return {
    			venuePublish: window.company.venue_publish,
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