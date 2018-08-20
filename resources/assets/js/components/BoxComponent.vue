<template>
	<div class="ui card">
		<div class="image image_container" :style="`background: url(${item.cover})`">
			<a class="owner" :href="/c/ + item.theme.company.slug">
				<div class="logo" :style="'background-image: url(' + item.theme.company.company_detail.logo + ')'"></div>
			</a>
			<span class="price">{{ item.price }} лв.</span>
		</div>
		<div class="content content_box">
			<a :href="'/event/' + item.id" class="header">{{ item.theme.title }}</a>
			<p style="text-transform: uppercase;"> {{ item.begin }}</p>
		</div>
		<div class="extra content">
			<div class="flex">
				<div>
					<el-tooltip class="item" effect="dark" content="Прегледан" placement="top">
						<i class="eye icon"></i>
					</el-tooltip>
						54
				</div>
				<el-tooltip class="item" effect="dark" content="Харесай" placement="top">
					<Like
						:likes="item.theme.only_like_count"
						:liked="item.theme.is_liked != null"
						:item_id="item.theme.id"
						:route="'/users/like/theme'">
					</Like>
				</el-tooltip>
				
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

    		}
    	},

        mounted() {
            console.log('Box Component mounted.')
        },

        methods: {
        	
        },

        created() {
        	
        }
    };
</script>

<style>
	.content_box {
		padding-top: 40px !important;
	}

	.box {
		background-color: #fff;
		border-radius: 3px;
    	height: 360px;
		box-shadow: 0 1px 6px rgba(31, 31, 31, 0.12), 0 1px 4px rgba(31, 31, 31, 0.12);
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
		top: 96px;
		left: 20px;
		padding: 6px;
		width: 64px;
		height: 64px;
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
		bottom: 10px;
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
		justify-content: space-around;
	}

	.views {
		flex: 1;
	}

	.likes {
		flex: 1;
	}

	.comments {
		flex: 1;
	}
</style>