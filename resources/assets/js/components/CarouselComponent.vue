<template>
	<el-carousel :interval="5000" arrow="always" height="500px">
		<el-carousel-item v-for="item in items" :key="item.id" :style="'background: url(/img/slider/' + item.cover + ')'">
			<div class="carousel_overlay">
				<div class="ui container">
					<h1 class="carousel_title">{{ item.title }}</h1>
					<h3 class="carousel_body">{{ item.body }}</h3>
				</div>
			</div>
		</el-carousel-item>
	</el-carousel>
</template>

<script>
	import { EventBus } from '../app';
    export default {

    	data: function () {
    		return {
    			items: {
    				0: {
    					id: 1,
    					title: 'first test title',
    					body: 'example test body',
    					cover: '1.jpeg'
    				},
    				1: {
    					id: 2,
    					title: 'second test title',
    					body: 'second example test body ',
    					cover: '2.jpeg'
    				}
    			}
    		}
    	},

        mounted() {
            console.log('Carousel mounter');
        },

        methods: {

        },

        created() {
    //     	let vm = this;
    //     	axios.get('/api/categories').then(function (response) {
    // 				vm.categories = response.data;
				// })
				// .catch(function (error) {
				// 	console.log(error);
				// });
        }
    };
</script>

<style>
.carousel_overlay {
	background: linear-gradient(to bottom right,#002f4b,#dc4225);
	opacity: .6;
	height: 100%;
}

.el-carousel__item {
	color: white;
	background-size: cover !important;
    background-position: center center !important;
	background-color: #99a9bf;
}

.el-carousel__item {
    content: '';
	position: absolute;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
}

.carousel_title {
	font-size: 4rem;
}

.carousel_title {
	font-size: 3rem;
}
/*.el-carousel__item:nth-child(2n+1) {
	background-color: #d3dce6;
}*/
</style>