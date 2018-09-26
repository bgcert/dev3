<template>
	<div>
		<div class="ui grid mt-20">
			<div class="two wide column">
				<div class="ui fluid vertical pointing menu">
					<a href="/" class="item"><i class="home icon"></i> Seminari365.com</a>
					<router-link
						to="/admin-users"
						class="item"
						:class="{ active: $route.path == '/admin-users' }">
						<i class="users icon"></i> Потребители
					</router-link>
					<router-link
						to="/admin-events"
						class="item"
						:class="{ active: $route.path == '/admin-events' }">
						Обучения
					</router-link>
					<router-link
						to="/teachers"
						class="item"
						:class="{ active: $route.path == '/teachers' }">
						Лектори
					</router-link>
					<router-link
						to="/admin-orders"
						class="item"
						:class="{ active: $route.path == '/admin-orders' }">
						Заявки
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

    		}
    	},

    	methods: {

    	},

        mounted() {
            console.log('Admin component mounted.')
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