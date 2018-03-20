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
    	props: ['liked'],

    	data: function () {
    		return {
    			isLiked: this.liked,
    			//id: this.company_id
    		}
    	},

    	methods: {
    		toggle() {
    			var vm = this;
    			// axios.post('/users/follow', { id: vm.id })
    			// .then(function (response) {
    			// 	vm.isFollowed = !vm.isFollowed;
    			// 	console.log(response);
    			// })
    			// .catch(function (error) {
    			// 	console.log(error);
    			// });
    			console.log('toggle like');
    		}
    	},

        mounted() {
            console.log('Component mounted.')
        }
    }
</script>