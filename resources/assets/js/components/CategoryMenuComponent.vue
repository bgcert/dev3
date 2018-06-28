<template>
	<div class="ui dropdown item">
		Категории  <i class="dropdown icon"></i>
		<div class="menu">
			<template v-for="category in categories">
				<a :href="'/browse/' + category.slug" class="item">{{ category.name }}</a>
			</template>
		</div>
	</div>
</template>

<script>
	import { EventBus } from '../app';
    export default {

    	data: function () {
    		return {
    			categories: []
    		}
    	},

        mounted() {
            console.log('Category Menu Component mounted.')
        },

        methods: {

        },

        created() {
        	let vm = this;
        	axios.get('/api/categories').then(function (response) {
    				vm.categories = response.data;
				})
				.catch(function (error) {
					console.log(error);
				});
        }
    };
</script>