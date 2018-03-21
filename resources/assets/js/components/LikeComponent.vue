<template>
	<div>
		<template v-if="auth == 1">
			<a href="#" @click.prevent="toggle"> 
				<template v-if="isLiked == 1">
					Unlike
				</template>
				<template v-else>
					Like
				</template>
			</a>	
		</template>
		<template v-else>
			<a href="#" @click.prevent="redirect">
				Like
			</a>
		</template>
		
		<span>({{ count }})</span>
	</div>
</template>

<script>
    export default {
    	props: ['auth', 'likes', 'liked', 'item_id', 'route'],

    	data: function () {
    		return {
    			isLiked: this.liked,
    			count: this.likes,
    		}
    	},

    	methods: {
    		toggle() {
    			var vm = this;
    			axios.post(vm.route, { id: vm.item_id })
    			.then(function (response) {
    				if (vm.isLiked == 1) {
    					vm.isLiked = 0;
    					vm.count--;
    				} else {
    					vm.isLiked = 1;
    					vm.count++;
    				}
    				console.log(response);
    			})
    			.catch(function (error) {
    				console.log(error);
    			});
    			console.log('toggle like');
    		},

    		redirect() {
    			window.location.href = '/login';
    		}
    	},

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>