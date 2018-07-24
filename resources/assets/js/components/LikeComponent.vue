<template>
	<span>
		<template v-if="auth">
			<span @click.prevent="toggle"> 
				
					<i class="thumbs up like icon" :class="{ liked: isLiked, outline: !isLiked }"></i>
				
			</span>	
		</template>
		<template v-else>
			<span href="#" @click.prevent="login">
				<i class="thumbs up outline like icon"></i>
			</span>
		</template>
		<template v-if="count">
			<span>{{ count }}</span>
		</template>
	</span>
</template>

<script>
	import { EventBus } from '../app';
    export default {
    	props: ['likes', 'liked', 'item_id', 'route'],

    	data: function () {
    		return {
                auth: window.auth,
    			isLiked: this.liked,
    			count: this.likes,
    		}
    	},

    	methods: {
    		toggle() {
    			var vm = this;
    			var msg = '';
    			axios.post(vm.route, { id: vm.item_id })
    			.then(function (response) {
    				if (vm.isLiked == 1) {
    					vm.isLiked = 0;
    					vm.count--;
    					msg = 'Item was unliked';
    				} else {
    					vm.isLiked = 1;
    					vm.count++;
    					msg = 'Item was liked';
    				}
					window.flash(msg, 'success');
    			})
    			.catch(function (error) {
    				console.log(error);
    			});
    		},

    		login() {
    			EventBus.$emit('loginClicked');
    		}
    	},

        mounted() {
            console.log('Component mounted.')
        }
    };
</script>

<style scoped>
	.liked {
		color: #ff851b;
	}
</style>