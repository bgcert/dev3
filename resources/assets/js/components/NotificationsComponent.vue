<template>
	<span class="item">
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
				<i class="bell outline icon"></i>
			</span>
		</el-popover>
	</span>
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
            console.log('Notifications component mounted.')
        }
    };
</script>