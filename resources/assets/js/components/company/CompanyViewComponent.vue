<template>
	<div>
		<div class="ui grid">
			<div class="row">

				<div class="column">
					<div class="cover-container" :style="'background: url(' + company.cover + ') center / cover no-repeat;'">
						<div class="overlay">
							<div class="data-container">
								<div class="logo-container">
									<img class="company-logo" :src="company.logo">
								</div>
								<div class="company-name">
									<h2>{{ company.name }}</h2>
								</div>
							</div>
						</div>
					</div>	
				</div>
				
			</div>

			<div class="row">
				<div class="column">
					<div class="ui secondary pointing menu">
						<a class="item active">
							Инфо
						</a>
						<a class="item">
							Обучения
						</a>
						<a class="item">
							Теми
						</a>
						<a class="item">
							Мнения
						</a>
						<div class="right menu">
							<div class="ui item">
								
							</div>
							<div class="ui item">
								<span>
									<a class="mini ui orange basic button" href="#"><i class="paper plane icon"></i> Изпрати съобщение</a>
								</span>
								<follow
									:followed="company.is_followed.length > 0"
									:company_id="company.id"
									>
								</follow>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="two column row">
				<div class="twelve wide column">
					<p>{{ company.description }}</p>

					<h3 class="ui dividing header">
						Themes
					</h3>
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

					<h3 class="ui dividing header">
						Events
					</h3>
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


					<h3 class="ui dividing header">
						Venues
					</h3>
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
					
					<h5 class="ui dividing header">
						Адрес
					</h5>
					<h5 class="ui dividing header">
						Карта
					</h5>
				</div>

			</div>
			
		</div>
		
	</div>
</template>

<script>
    export default {
    	props: ['slug'],

    	data: function () {
    		return {
    			company: []
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