<template>
	<span>
		<template v-if="auth == 1">
			<span @click.prevent="toggle"> 
				<template v-if="isLiked == 1">
						<i class="heart red like icon"></i>
				</template>
				<template v-else>
						<i class="heart outline like icon"></i>
				</template>
			</span>	
		</template>
		<template v-else>
			<span href="#" @click.prevent="login">
				<i class="heart outline like icon"></i>
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
    }
</script>