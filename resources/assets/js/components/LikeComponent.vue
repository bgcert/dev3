<template>
	<div>
		<a href="#" @click.prevent="toggle"> 
			<template v-if="isLiked == 1">
				Unlike
			</template>
			<template v-else>
				Like
			</template>
		</a>
	</div>
</template>

<script>
    export default {
    	props: ['liked', 'item_id', 'route'],

    	data: function () {
    		return {
    			isLiked: this.liked,
    		}
    	},

    	methods: {
    		toggle() {
    			var vm = this;
    			axios.post(vm.route, { id: vm.item_id })
    			.then(function (response) {
    				vm.isLiked = !vm.isLiked;
    				console.log(response);
    			})
    			.catch(function (error) {
    				console.log(error);
    			});
    			console.log('toggle like');
    		}
    	},

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>