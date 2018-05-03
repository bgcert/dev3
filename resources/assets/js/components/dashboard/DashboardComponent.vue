<template>
	<div>
		<div class="ui grid">
			<div class="four wide column">
				<div class="ui fluid vertical pointing menu">
					<router-link to="/home" class="item">Home</router-link>
					<router-link to="/about" class="item">About</router-link>
					<router-link to="/themes" class="item">Теми</router-link>
					<router-link to="/events" class="item">Календар</router-link>
				</div>
			</div>
			<div class="twelve wide column">
				<router-view></router-view>
			</div>
		</div>
	</div>
</template>

<script>
	import { EventBus } from '../../app';
    export default {

    	data: function () {
    		return {
    			isCollapse: false
    		}
    	},

    	methods: {
    		handleOpen(key, keyPath) {
    			console.log(key, keyPath);
    		},

    		handleClose(key, keyPath) {
    			console.log(key, keyPath);
    		}
    	},

        mounted() {
            console.log('Dashboard mounted.')
        },

        created() {
            
        }
    }
</script>

<style>
	.el-menu-vertical-demo:not(.el-menu--collapse) {
		min-height: 400px;
	}
</style>