<template>
	<div>
		<el-row>
			<el-col :span="6">
				<div class="grid-content bg-purple">
					<el-radio-group v-model="isCollapse" style="margin-bottom: 20px;">
						<el-radio-button :label="false">expand</el-radio-button>
						<el-radio-button :label="true">collapse</el-radio-button>
					</el-radio-group>
					<el-menu default-active="1" class="el-menu-vertical-demo" @open="handleOpen" @close="handleClose" :collapse="isCollapse">
						<el-menu-item index="1">
							<i class="el-icon-menu"></i>
							<span slot="title">Теми</span>
						</el-menu-item>
						<el-menu-item index="2">
							<i class="el-icon-menu"></i>
							<span slot="title">Календар</span>
						</el-menu-item>
						<el-menu-item index="3">
							<i class="el-icon-menu"></i>
							<span slot="title">Зали</span>
						</el-menu-item>
						<el-menu-item index="4">
							<i class="el-icon-document"></i>
							<span slot="title">Заявки</span>
						</el-menu-item>
						<el-menu-item index="5">
							<i class="el-icon-setting"></i>
							<span slot="title">Navigator Four</span>
						</el-menu-item>
					</el-menu>
				</div>
			</el-col>
			<el-col :span="12">
				<div class="grid-content">
					<el-container>
						<el-main>
							
						</el-main>
					</el-container>
				</div>
			</el-col>
		</el-row>
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
            var vm = this;
            var route = '/dashboard/themes';
        	axios.get(route).then(function (response) {
        		console.log(response.data);
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    }
</script>

<style>
	.el-menu-vertical-demo:not(.el-menu--collapse) {
		min-height: 400px;
	}
</style>