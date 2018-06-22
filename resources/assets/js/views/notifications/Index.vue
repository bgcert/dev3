<template>
	<div class="ui segments">
		<div class="ui clearing segment">
			<h3 style="float: left;">Известия</h3>
		</div>

		<div class="ui segment">
			<div class="ui very relaxed divided list">
				<div class="item">
					<img class="ui avatar image" src="https://picsum.photos/280/280/?image=123">
					<div class="content">
						<a class="header">Daniel Louise</a>
						<div class="description">Last seen watching <a><b>Arrested Development</b></a> just now.</div>
					</div>
				</div>
				<div class="item">
					<img class="ui avatar image" src="https://picsum.photos/280/280/?image=124">
					<div class="content">
						<a class="header">Stevie Feliciano</a>
						<div class="description">Last seen watching <a><b>Bob's Burgers</b></a> 10 hours ago.</div>
					</div>
				</div>
				<div class="item">
					<img class="ui avatar image" src="https://picsum.photos/280/280/?image=125">
					<div class="content">
						<a class="header">Elliot Fu</a>
						<div class="description">Last seen watching <a><b>The Godfather Part 2</b></a> yesterday.</div>
					</div>
				</div>
			</div>
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
            console.log('Notifications view mounted.');
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