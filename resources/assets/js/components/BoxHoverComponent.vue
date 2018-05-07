<template>
    <span>
		<el-popover
			slot="reference"
			class="extra content"
			@show="getCompany(id)"
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
	                        <a class="ui sub header" :href="'/c/' + company.slug">{{ name }}</a>
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
				<a :href="'/c/' + company.slug">{{ name }}</a>
			</span>
		</el-popover>
    </span>
</template>

<script>
    export default {
    	props: ['id', 'name'],

    	data: function () {
    		return {
    			company: [],
    			loading: true,
    		}
    	},

    	methods: {

    		getCompany: function(id) {
    			this.loading = true;
    			let vm = this;
    			let route = '/data/getcompany/' + id;
    			axios.get(route).then(function (response) {
    				console.log(response.data);
    				vm.company = response.data;
    				vm.loading = false;
				})
				.catch(function (error) {
					console.log(error);
				});
    		}
    	}
    }
</script>

<style>
	.user-popover {
        position: absolute;
        z-index:999;
        bottom: 20px;
    }

    .ui.card {
		min-height: 200px;
		box-shadow: none;
	}
    
</style>