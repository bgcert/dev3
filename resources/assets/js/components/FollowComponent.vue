<template>
	<div>
		<a href="#" @click.prevent="toggle"> 
			<template v-if="isFollowed">
				Unfollow
			</template>
			<template v-else>
				Follow
			</template>
		</a>
	</div>
</template>

<script>
    export default {
    	props: ['followed', 'company_id'],

    	data: function () {
    		return {
    			isFollowed: this.followed,
    			id: this.company_id
    		}
    	},

    	methods: {
    		toggle() {
    			var vm = this;
    			axios.post('/users/follow', { id: vm.id })
    			.then(function (response) {
    				vm.isFollowed = !vm.isFollowed;
    				console.log(response);
    			})
    			.catch(function (error) {
    				console.log(error);
    			});
    		}
    	},

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>