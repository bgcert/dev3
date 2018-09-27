<template>
	<div class="ui card" v-popover:popover>
		<a :href="'/event/' + item.id" class="image image_container" :style="`background: url(${ 'https://d3cwccg7mi8onu.cloudfront.net/266x132/' + item.cover })`">
			<a class="owner" :href="/c/ + item.theme.company.slug">
				<img :src="'https://d3cwccg7mi8onu.cloudfront.net/50x50/' + item.theme.company.logo">
			</a>
			<span class="price">{{ item.price }} лв.</span>
		</a>
		<div class="content content-box">
			<a :href="'/event/' + item.id" class="header">{{ item.theme.title }}</a>
			<p style="text-transform: uppercase;"> {{ item.start_date_carbon }}</p>
		</div>
		<div class="extra content">
			<div class="flex">
				<div>
					<el-rate
						v-model="item.theme.averageRating"
						disabled
						text-color="#ff9900"
						score-template="{value}">
					</el-rate>
				</div>
				<!-- <div>
					<el-tooltip class="item" effect="dark" content="Прегледан" placement="top">
						<i class="eye icon"></i>
					</el-tooltip>
						--
				</div> -->
<!-- 				<el-tooltip class="item" effect="dark" content="Харесай" placement="top">
					<Like
						:likes="item.theme.only_like_count"
						:liked="item.theme.is_liked != null"
						:item_id="item.theme.id"
						:route="'/users/like/theme'">
					</Like>
				</el-tooltip> -->
				
				<a :href="'/event/' + item.id + '/#comments'">
					<el-tooltip class="item" effect="dark" content="Коментари" placement="top">
						<i class="comment outline icon"></i>
					</el-tooltip>
					{{ item.theme.only_comment_count }}
				</a>
			</div>
		</div>
	</div>
</template>

<script>
	import Like from './LikeComponent.vue'
    export default {
    	components: { Like },
    	props: ['item'],
    	data: function () {
    		return {
    			loading: true
    		}
    	},

        methods: {
        	test() {
        		console.log('enter');
        		this.showPopper = true;
        	}
        },

        mounted() {
            console.log('Box Component mounted.')
        },

        created() {
        	
        }
    };
</script>

<style>
	.content-box {
		padding-top: 40px !important;
	}

	.content-box a {
		font-size: 1.16em !important;
	}

	.ui .card {
    	height: 360px;
		cursor: pointer;
	}

	.image_container {
		height: 132px;
		background-size: cover !important;
		background-position: center center !important;
		border-top-left-radius: 3px;
		border-top-right-radius: 3px;
		position: relative;
	}

	.owner {
		position: absolute;
		top: 101px;
		left: 20px;
		padding: 5px;
		width: 62px;
		height: 62px;
		background: #fff;
		border: 1px solid #E1E1E1;
		border-radius: 3px;

	}

	.logo_container {
		height: 80px;
		width: 80px;
	}

	.logo {
		width: 100%;
		height: 100%;
		background-size: cover !important;
    	background-position: center center !important;
	}

	.price {
		background: #fff;
		position: absolute;
		right: 10px;
		top: 10px;
		padding: 5px;
		border-radius: 2px;
		border: 1px solid #E1E1E1;
	}

	.content_container {
		padding: 40px 20px 20px 20px;
	}

	.box_title {
		font-size: 1.4rem;
		line-height: 1.6rem;
		padding-bottom: 8px;
	}

	.box_date {
		color: rgb(117, 117, 117);
		font-size: 1rem;
	}

	.box_footer {
		display: flex;
		justify-content: space-between;
	}

	.views { flex: 1; }
	.likes { flex: 1; }
	.comments { flex: 1; }

	/* Popover */
	.p_logo {
		max-height: 62px;
	}

</style>