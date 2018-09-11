<template>
	<div>
		<el-carousel height="380px" :autoplay="false" arrow="always">
			<el-carousel-item v-for="image in images" :key="image.id">
				<div class="img-container" :style="'background-image: url(https://d3cwccg7mi8onu.cloudfront.net/fit-in/1200x400/' + image.filename + ')'">
				</div>
				<img :src="image.filename">
			</el-carousel-item>
		</el-carousel>
	</div>
</template>

<script>
	import { EventBus } from '../app';
    export default {
    	props: ['id', 'cover'],
    	
    	data: function () {
    		return {
    			images: []
    		}
    	},

        mounted() {
            console.log('Venue Slider Component mounted.')
        },

        methods: {

        },

        created() {
        	var vm = this;
        	var route = '/load/venue/images/' + this.id;
        	axios.get(route).then(function (response) {
        		vm.images = response.data;
        		vm.images.unshift({"filename": vm.cover});
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>

<style>
	.el-carousel__item h3 {
		color: #475669;
		font-size: 14px;
		opacity: 0.75;
		line-height: 200px;
		margin: 0;
	}

	.el-carousel__item:nth-child(2n) {
		background-color: #99a9bf;
	}

	.el-carousel__item:nth-child(2n+1) {
		background-color: #d3dce6;
	}

	.img-container {
		background: center center / cover no-repeat;
		height: 100%;
	}
</style>