<template>
	<span class="left floated">
		<a class="mini ui basic button" href="#" @click.prevent="toggle">
			<template v-if="isFollowed">
				Не следвай
			</template>
			<template v-else>
				Следвай
			</template>
		</a>
	</span>
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
    				console.log(vm.isFollowed);
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