<template>
	<div>
		<div class="ui grid" v-if="company != null">
			<div class="row">

				<div class="column">
					<div class="cover-container" :style="'background: url(https://d3cwccg7mi8onu.cloudfront.net/1200x300/' + company.cover + ') center / cover no-repeat;'">
						<div class="overlay">
							<div class="data-container">
								<div class="logo-container">
									<img :src="'https://d3cwccg7mi8onu.cloudfront.net/fit-in/200x200/' + company.logo">
								</div>
								<div class="company-name">
									<h2>{{ company.name }}</h2>
								</div>
								<div style="position: absolute; right: 40px; bottom: 20px;">
									<contact-publisher
										button-text="Свържете се с нас"
										:company-id="company.id"
										:about="company.name"
										btn-class="orange small">
									</contact-publisher>
									<!-- <a :href="'/messages#/' + company.user.id" class="ui mini orange button">Изпрати съобщение</a> -->
									<!-- <Follow
										:followed="company.is_followed.length > 0"
										:company_id="company.id">
									</Follow> -->
								</div>
							</div>
						</div>
					</div>	
				</div>
				
			</div>

			<div class="two column row">
				<div class="twelve wide column">
					<el-tabs type="card" v-model="activeName">
						<el-tab-pane label="Инфо" name="info">
							<p v-if="company.description">{{ company.description }}</p>
							<p>{{ company.name }}</p>
						</el-tab-pane>
						<el-tab-pane label="Теми" name="themes" v-if="company.themes.length > 0">
							<div class="ui items">
								<template v-for="theme in company.themes">
									<div class="item">
										<div class="ui small image">
											<img :src="'https://d3cwccg7mi8onu.cloudfront.net/250x150/' + theme.cover">
										</div>
										<div class="content">
											<a :href="'/theme/' + theme.id" class="header">{{ theme.title }}</a>
											<div class="meta">
												<span>{{ theme.body }}</span>
											</div>
											<div class="description">
												<p></p>
											</div>
											<!-- <div class="extra">
												Additional Details
											</div> -->
										</div>
									</div>
								</template>
							</div>
						</el-tab-pane>
						<el-tab-pane label="Събития" name="events" v-if="company.events.length > 0">
							<div class="ui items">
								<template v-for="event in company.events">
									<div class="item">
										<div class="ui small image">
											<img :src="'https://d3cwccg7mi8onu.cloudfront.net/250x150/' + event.cover">
										</div>
										<div class="content">
											<a :href="'/event/' + event.id" class="header">{{ event.theme.title }}</a>
											<div class="meta">
												<span>{{ event.begin }}</span>
											</div>
											<div class="description">
												<p></p>
											</div>
											<!-- <div class="extra">
												Additional Details
											</div> -->
										</div>
									</div>
								</template>
							</div>
						</el-tab-pane>
						<el-tab-pane label="Зали" name="venues" v-if="company.venues.length > 0">
							<div class="ui items">
								<template v-for="venue in company.venues">
									<div class="item">
										<div class="ui small image">
											<img :src="'https://d3cwccg7mi8onu.cloudfront.net/250x150/' + venue.cover">
										</div>
										<div class="content">
											<a :href="'/venue/' + venue.id" class="header">{{ venue.name }}</a>
											<div class="meta">
											</div>
											<div class="description">
												<p></p>
											</div>
											<div class="extra">
												{{ venue.capacity }} места
											</div>
										</div>
									</div>
								</template>
							</div>
						</el-tab-pane>
					</el-tabs>
				</div>

				<div class="four wide column" style="display: none;">
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
									{{ company.phone }}
								</div>
							</div>
							<div class="item">
								<i class="marker icon"></i>
								<div class="content">
									{{ company.address }}
								</div>
							</div>
							<div class="item">
								<i class="mail icon"></i>
								<div class="content">
									<a href="mailto:jack@semantic-ui.com">{{ company.email }}</a>
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
    			company: null,
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
			let route = '/api/company/details/' + this.slug;
			axios.get(route).then(function (response) {
        		vm.company = response.data;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>

<style>
	.data-container { padding: 30px; height: 260px; }

	.logo-container {
		background-size: contain !important;
    	background-position: center center !important;
    	background-repeat: no-repeat !important;
    	/*border-radius: 50%;*/
		display: inline-block;
		float: left;
		margin-right: 30px;
		/*border: 2px solid white;*/
		width: 200px;
		height: 200px;
	}
	.logo-container img {
		border: 2px solid white;
	}

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