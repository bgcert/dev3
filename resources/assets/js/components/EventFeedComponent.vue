<template>
	<div>
		<request-modal
			auth="1"
			>
		</request-modal>

		<div class="ui three stackable cards">
			<template v-for="event in events">
				<div class="card">
					<el-popover
						slot="reference"
						class="extra content"
						@show="getCompany(event.theme.company.id)"
						placement="top"
						width="250"
						trigger="hover">

						
						<div class="ui card" v-loading="loading">
							<template v-if="!loading">
				                <div class="center aligned content">
				                    <a :href="'/c/' + company.slug">
				                        <img class="ui tiny circular image" :src="company.logo">
				                    </a>
				                    <div class=" header">
				                        <a class="ui sub header" :href="'/c/' + company.slug">{{ company.name }}</a>
				                    </div>
				                </div>
				                <div class="extra content">
			                		<follow
				                        :followed="company.is_followed"
				                        :company_id="company.id"
				                        >
				                    </follow>
				                    
				                    <template v-for="follower in company.first_five_followers">
										<el-tooltip class="item" effect="dark" :content="follower.name" placement="top">
											<img :src="follower.picture" class="ui avatar image">
										</el-tooltip>
									</template>                    
				                </div>
			                </template>
			            </div>

						<span slot="reference">
							<a :href="'/c/' + event.theme.company.slug">{{ event.theme.company.name }}</a>
						</span>
					</el-popover>
					<div class="image">
						<img :src="event.cover">
					</div>
					<div class="content">
						<p style="text-transform: uppercase;">
							{{ event.begin_at }}
						</p>
						<a :href="'/event/' + event.id" class="header">{{ event.theme.title }}</a>
					</div>
					<div class="extra content">
						<span class="right floated">
							<like
								:auth="auth"
								:likes="(event.theme.like_count != null) ? event.theme.like_count.count : ''"
								:liked="event.theme.is_liked.length"
								:item_id="event.theme.id"
								:route="'/users/like/theme'"
								>
							</like>
							<span>
								<a :href="'/event/' + event.id + '/#comments'">
									<i class="comment outline icon"></i>
									{{ event.theme.comment_count.count }}
								</a>
							</span>
						</span>
					</div>
				</div>
			</template>
		</div>

	</div>
</template>

<script>
	import { EventBus } from '../app';
    export default {
    	props: ['auth'],

    	data: function () {
    		return {
    			events: {},
    			company: [],
    			loading: true,
    		}
    	},

    	methods: {
    		date(date) {
    			return moment(date).format('ddd, D MMM YYYY');
    		},

    		request(id) {
    			EventBus.$emit('testlog', 'some message');
    			console.log('request ' + id);
    		},

    		getCompany: function(id) {
    			this.loading = true;
    			let vm = this;
    			let route = '/data/getcompany/' + id;
    			axios.get(route).then(function (response) {
    				console.log(response.data);
    				vm.company = response.data;
    				vm.loading = false;
	        		//vm.company = response.data;
					console.log(response);
				})
				.catch(function (error) {
					console.log(error);
				});
    		}
    	},

        created() {
            var vm = this;
        	axios.get('/data/eventlist').then(function (response) {
        		vm.events = response.data;
        		console.log('event list');
				console.log(vm.events);
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    }
</script>

<style>
	.ui.card {
		min-height: 200px;
		box-shadow: none;
	}
</style>