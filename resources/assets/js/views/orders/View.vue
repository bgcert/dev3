<template>
	<div class="ui segments">
		<div class="ui clearing segment">
			<h3 style="float: left;">Заявка ID</h3>
		</div>
	</div>
</template>

<script>
    export default {
    	data: function () {
    		return {

    		}
    	},

    	methods: {

    	},

        mounted() {
            console.log('Orders create mounted.');
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