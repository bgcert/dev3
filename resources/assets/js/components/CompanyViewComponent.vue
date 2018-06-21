<template>
	<div>
		<div class="ui grid">
			<div class="row">

				<div class="column">
					<div class="cover-container" :style="'background: url(' + company.company_detail.cover + ') center / cover no-repeat;'">
						<div class="overlay">
							<div class="data-container">
								<div class="logo-container">
									<img class="company-logo" :src="company.company_detail.logo">
								</div>
								<div class="company-name">
									<h2>{{ company.name }}</h2>
								</div>
								<div style="position: absolute; right: 40px; bottom: 20px;">
									<a :href="'/messages#/t?contact=' + company.user.id" class="ui mini orange button">Изпрати съобщение</a>
									<Follow
										:followed="company.is_followed.length > 0"
										:company_id="company.id"
										>
									</Follow>
								</div>
							</div>
						</div>
					</div>	
				</div>
				
			</div>

			<div class="two column row">
				<div class="twelve wide column">
					<el-tabs type="card" v-model="activeName" @tab-click="handleClick">
						<el-tab-pane label="Инфо" name="info">
							<p>{{ company.company_detail.description }}</p>
							<div class="extra">
								<a :href="'http://www.facebook.com/' + company.company_detail.facebook" class="ui facebook mini button">
									<i class="facebook icon"></i>
									Facebook
								</a>
								<a :href="'instagram.com/' + company.company_detail.instagram" class="ui instagram mini button">
									<i class="instagram icon"></i>
									Instagram
								</a>
								<a :href="'http://linkedin.com/' + company.company_detail.linkedin" class="ui linkedin mini button">
									<i class="linkedin icon"></i>
									LinkedIn
								</a>
								<a :href="'http://youtube.com/' + company.company_detail.youtube" class="ui youtube mini button">
									<i class="youtube icon"></i>
									YouTube
								</a>
							</div>
						</el-tab-pane>
						<el-tab-pane label="Теми" name="themes">
							<div class="ui items">
								<template v-for="theme in company.themes">
									<div class="item">
										<div class="ui small image">
											<img :src="theme.cover">
										</div>
										<div class="content">
											<a :href="'/theme/' + theme.id" class="header">{{ theme.title }}</a>
											<div class="meta">
												<span>{{ theme.body }}</span>
											</div>
											<div class="description">
												<p></p>
											</div>
											<div class="extra">
												Additional Details
											</div>
										</div>
									</div>
								</template>
							</div>
						</el-tab-pane>
						<el-tab-pane label="Събития" name="events">
							<div class="ui items">
								<template v-for="event in company.events">
									<div class="item">
										<div class="ui small image">
											<img :src="event.cover">
										</div>
										<div class="content">
											<a :href="'/event/' + event.id" class="header">{{ event.title }}</a>
											<div class="meta">
												<span>{{ event.body }}</span>
											</div>
											<div class="description">
												<p></p>
											</div>
											<div class="extra">
												Additional Details
											</div>
										</div>
									</div>
								</template>
							</div>
						</el-tab-pane>
						<el-tab-pane label="Зали" name="venues">
							<div class="ui items">
								<template v-for="venue in company.venues">
									<div class="item">
										<div class="ui small image">
											<img :src="venue.cover">
										</div>
										<div class="content">
											<a :href="'/venue/' + venue.id" class="header">{{ venue.name }}</a>
											<div class="meta">
											</div>
											<div class="description">
												<p></p>
											</div>
											<div class="extra">
												Additional Details
											</div>
										</div>
									</div>
								</template>
							</div>
						</el-tab-pane>
					</el-tabs>
				</div>

				<div class="four wide column">
					<h5 class="ui dividing header">
						Последователи
					</h5>
					<div class="ui huge horizontal list">
						<template v-for="follower in company.followers">
							<el-tooltip class="item follower" effect="dark" :content="follower.name" placement="top">
								<div class="item">
									<img class="ui avatar image" :src="follower.picture">
								</div>
							</el-tooltip>
						</template>
					</div>
					<div class="ui segment">
						<div class="ui list">
							<div class="item">
								<i class="phone icon"></i>
								<div class="content">
									{{ company.company_detail.phone }}
								</div>
							</div>
							<div class="item">
								<i class="marker icon"></i>
								<div class="content">
									{{ company.company_detail.address }}
								</div>
							</div>
							<div class="item">
								<i class="mail icon"></i>
								<div class="content">
									<a href="mailto:jack@semantic-ui.com">{{ company.company_detail.email }}</a>
								</div>
							</div>
							<div class="item">
								<i class="linkify icon"></i>
								<div class="content">
									<a href="http://www.semantic-ui.com">semantic-ui.com</a>
								</div>
							</div>
						</div>
					</div>
					<h5 class="ui dividing header">
						Карта
					</h5>
				</div>

			</div>
			
		</div>
		
	</div>
</template>

<script>
	import Follow from './FollowComponent.vue'
    export default {
    	components: {
			Follow
		},
    	props: ['slug'],

    	data: function () {
    		return {
    			company: [],
    			activeName: 'info'
    		}
    	},

    	methods: {

    	},

        mounted() {
            console.log('Component mounted.')
        },

        created() {
        	let vm = this;
			let route = '/data/company/details/' + this.slug;
			axios.get(route).then(function (response) {
        		vm.company = response.data;
				console.log(response.data);
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    }
</script>

<style>

	.data-container { padding: 30px; height: 260px; }

	.logo-container { display: inline-block; float: left; margin-right: 30px; }
	.logo-container img { border: 2px solid white; }

	.company-logo { border-radius: 50%; height: 200px; }

	.company-name {
		background: rgba(0,0,0,.8);
		color: white;
		padding: 4px 7px;
		float: left;
	}

	.overlay {
		background: linear-gradient(45deg, rgba(26, 0, 0, 0.6) 0%, rgba(26, 0, 0, 0.2) 100%);
	}

	.follower {
		margin-left: -12px !important;
	}

	.follower.item img {
		border: 2px solid white !important;
	}
</style>