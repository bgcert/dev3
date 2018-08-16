<template>
	<div>
		<el-carousel :interval="5000" arrow="always" height="500px">
			<el-carousel-item v-for="item in items" :key="item.id" :style="'background: url(/img/slider/' + item.cover + ')'">
				<div class="carousel_overlay">
					<div class="carousel_container">
						<div style="text-align: center;">
							<h1 class="carousel_title">{{ item.title }}</h1>
							<h3 class="carousel_body">{{ item.body }}</h3>
							<a href="#" class="ui huge inverted button">Регистрация</a>
							<a href="#" class="ui huge inverted button">Вход</a>
						</div>
					</div>
				</div>
			</el-carousel-item>
		</el-carousel>
		<div class="publish">
			<div style="text-align: center;">
				<h4>Публикувайте Вашите обучения или зали в Семинари 365. <span><a class="ui inverted button" href="#">Вижте как?</a></span></h4>
			</div>
		</div>
	</div>
</template>

<script>
	import { EventBus } from '../app';
    export default {

    	data: function () {
    		return {
    			items: {
    				0: {
    					id: 1,
    					title: 'Семинари 365',
    					body: 'Постоянно развитие',
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
	background-image: linear-gradient(to bottom right, rgba(0, 47, 75, 0.7) 0%, rgba(220, 66, 37, 0.40) 100%);
	height: 100%;
}

.carousel_container {
	display: flex;
	justify-content: center;
	align-items: center;
	height: 100%;
}

.el-carousel__item {
	color: white;
	text-shadow: 0 2px 3px rgba(41,48,59,.2);
	background-size: cover !important;
    background-position: center center !important;
	background-color: #99a9bf;
}

/*.el-carousel__item {
    content: '';
	position: absolute;
	top: 0;
	right: 0;
	bottom: 0;
	left: 0;
}*/

.carousel_title {
	font-size: 4rem;
}

.carousel_body {
	font-size: 2.2rem;
}

.publish {
	color: white;
	background-color: #FFE53B;
	background-image: linear-gradient(147deg, #FFE53B 0%, #FF2525 74%);
	padding: 16px 0;
	margin: 0 auto;
}

.publish_link {
	color: white !important;
}
/*.el-carousel__item:nth-child(2n+1) {
	background-color: #d3dce6;
}*/
</style>