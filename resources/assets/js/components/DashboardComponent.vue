<template>
	<div>
		<div class="ui grid">
			<div class="four wide column">
				<div class="ui fluid vertical pointing menu">
					<router-link
						to="/profile"
						class="item"
						:class="{ active: $route.path == '/profile' }">
						Фирмен профил
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
				</div>
			</div>
			<div class="twelve wide column">
				<router-view></router-view>
			</div>
		</div>
	</div>
</template>

<script>
	import { EventBus } from '../app';
    export default {

    	data: function () {
    		return {
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