<template>
	<div class="row">
		<div class="col-3">
			<div class="list-group">
				<a href="/" class="list-group-item list-group-item-action"><i class="home icon"></i> Seminari365.com</a>
				<router-link
					to="/admin-users"
					class="list-group-item list-group-item-action"
					:class="{ active: $route.path == '/admin-users' }">
					<i class="users icon"></i> Потребители
				</router-link>

				<router-link
					to="/admin-events"
					class="list-group-item list-group-item-action"
					:class="{ active: $route.path == '/admin-events' }">
					Обучения
				</router-link>

				<router-link
					to="/admin-orders"
					class="list-group-item list-group-item-action"
					:class="{ active: $route.path == '/admin-orders' }">
					Заявки
				</router-link>
				<a href="#" class="list-group-item list-group-item-action disabled">Запитвания</a>
			</div>
		</div>
		
		<div class="col-9">
			<!-- <keep-alive> -->
				<router-view></router-view>
			<!-- </keep-alive> -->
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