<template>
    <div style="position:relative;">
		<div class="user-popover" v-if="showPopup" transition="fade" @mouseover="hoverInfo" @mouseout="hoverOutInfo">
			<h3><a :href="'/c/' + company.slug">{{ name }}</a></h3>
			<follow
				:followed="company.is_followed.length > 0"
				:company_id="company.id"
				>
			</follow>
			<hr>
			<ul style="list-style-type: none;">
				<template v-for="user in company.first_five_followers">
					<li style="display: inline; margin: 0 0 0 1px;"><a :href="'/user/' + user.id"><img :src="user.picture" style="border-radius: 4px; width: 25px;"></a></li>
				</template>
			</ul>
		</div>
		<a href="#" @mouseover="hover" @mouseout="hoverOut">{{ name }}</a>
    </div>
</template>

<script>
    export default {
    	props: ['name', 'id'],

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
	.user-popover{
        position: absolute;
        width: 250px;
        background: #fff;
        border: 1px solid #42b983;
        padding: 10px 20px;
        box-shadow: 0 6px 6px rgba(16, 16, 16, 0.04), 0 6px 6px rgba(0, 0, 0, 0.05);
        z-index:999;
        bottom: 20px;
    }

    button{
        background: #42b983;
        font-family: 'Montserrat', sans-serif;
        border: 1px solid #42b983;
        padding: 12px;
        font-size: 12px;
        color: #fff;
        outline: none;
        display: inline-block;
        text-align: center;
        padding: 6px 12px;
        border-radius: 3px;
        user-select: none;
        margin: 0 0 5px 0;
    }
</style>