<template>
	<div class="ui segments">
		<div class="ui clearing segment">
			<h3 style="float: left;">Заявки</h3>
			<router-link to="/orders/create" class="item" style="float: right;">
				<button class="ui tiny basic button">
					<i class="plus icon"></i>
					Въведи заявка
				</button>
			</router-link>
		</div>
		<div class="ui segment" v-loading="loading" style="min-height: 200px;">
			<h1>test</h1>
		</div>
	</div>
</template>

<script>
    export default {
    	data: function () {
    		return {
    			loading: false,
    		}
    	},

    	methods: {

    	},

        mounted() {
            console.log('Orders index mounted.');
        },

        created() {
   //      	var vm = this;
   //          var route = '/dashboard/events';
   //      	axios.get(route).then(function (response) {
   //      		console.log(response.data);
   //      		vm.events = response.data;
   //      		vm.loading = false;
			// })
			// .catch(function (error) {
			// 	console.log(error);
			// });
        }
    };
</script>