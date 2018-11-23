<template>
	<div class="row mt-4">
		<div class="col-lg-3 col-sm-12 mb-sm-4">
			<div class="list-group">
				<!-- <div class="list-group-item d-flex justify-content-between align-items-center">
					
				</div> -->
				<router-link
					to="/contacts"
					class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
					:class="{ active: $route.path == '/contacts' }">
					Съобщения
					<span class="badge badge-primary badge-pill" :class="{ 'badge-light': $route.path == '/contacts' }">14</span>
				</router-link>

				<router-link
					to="/themes"
					class="list-group-item list-group-item-action"
					:class="{ active: $route.path == '/themes' }">
					Теми
				</router-link>

				<router-link
					to="/teachers"
					class="list-group-item list-group-item-action"
					:class="{ active: $route.path == '/teachers' }">
					Лектори
				</router-link>

				<router-link
					to="/events"
					class="list-group-item list-group-item-action"
					:class="{ active: $route.path == '/events' }">
					Календар
				</router-link>

				<router-link v-if="venuePublish"
					to="/venues"
					class="list-group-item list-group-item-action"
					:class="{ active: $route.path == '/venues' }">
					Зали
				</router-link>

				<router-link
					to="/orders"
					class="list-group-item list-group-item-action d-flex justify-content-between align-items-center"
					:class="{ active: $route.path == '/orders' }">
					Заявки
					<span class="badge badge-primary badge-pill" :class="{ active: $route.path == '/orders' }">14</span>
				</router-link>

				<router-link
					to="/profile"
					class="list-group-item list-group-item-action"
					:class="{ active: $route.path == '/profile' }">
					Фирмени данни
				</router-link>
			</div>
		</div>

		<div class="col-lg-9 col-sm-12">
			<div class="card">
				<div class="card-body">
					<router-view></router-view>
				</div>
			</div>
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