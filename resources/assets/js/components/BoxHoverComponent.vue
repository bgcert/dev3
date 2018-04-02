<template>
    <span style="position:relative;">
		<a class="user-popover" v-if="showPopup" transition="fade" @mouseover="hoverInfo" @mouseout="hoverOutInfo">
            <div class="ui card">
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
                        :followed="company.is_followed.length > 0"
                        :company_id="company.id"
                        >
                    </follow>
                    <span class="left floated">
                        <ul style="list-style-type: none; margin: 1px 0; padding: 0 0 0 10px;">
                            <template v-for="user in company.first_five_followers">
                                <li style="display: inline; margin: 0 0 0 2px;"><a :href="'/user/' + user.id"><img :src="user.picture" style="border-radius: 4px; width: 25px;"></a></li>
                            </template>
                        </ul>
                    </span>
                    
                </div>
            </div>
			
		</a>
		<a :href="'/c/' + company.slug">
			<img :src="logo" class="ui avatar image">
		</a>
		<a :href="'/c/' + company.slug" @mouseover="hover" @mouseout="hoverOut">{{ name }}</a>
    </span>
</template>

<script>
    export default {
    	props: ['name', 'logo', 'id'],

    	data: function () {
    		return {
    			showPopup: false,
    			timer: '',
    			isInInfo: false,
    			company: []
    		}
    	},

    	methods: {

    		hover: function()
    		{
    			let vm = this;
    			this.getCompany();
    		},

    		hoverOut: function()
    		{
    			let vm = this;
    			clearTimeout(vm.timer);
    			this.timer = setTimeout(function() {
    				if(!vm.isInInfo)
    				{
    					vm.closePopover();
    				}
    			}, 200);
    		},

    		hoverInfo: function()
    		{
    			this.isInInfo = true;
    		},

    		hoverOutInfo: function()
    		{
    			this.isInInfo = false;
    			this.hoverOut();
    		},

    		showPopover: function()
    		{
    			this.showPopup = true;
    		},

    		closePopover: function()
    		{
    			this.showPopup = false;
    		},

    		getCompany: function() {
    			let vm = this;
    			let route = '/data/getcompany/' + this.id;
    			axios.get(route).then(function (response) {
	        		vm.company = response.data;
	        		vm.timer = setTimeout(function() {
	    				vm.showPopover();
	    			}, 600);
					console.log(response);
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
    
</style>