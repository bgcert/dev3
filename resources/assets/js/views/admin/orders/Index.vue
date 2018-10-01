<template>
	<div>
		<table class="ui selectable celled small table"  v-if="orders.length > 0">
			<thead>
				<tr>
					<th>#ID</th>
					<th>Заявил</th>
					<th>Събитие</th>
					<th>Фирма</th>
					<th>Регистриран на:</th>
					<th></th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="order in orders">
					<td>{{ order.id }}</td>
					<td>{{ order.contact_person }}</td>
					<td>{{ order.event_start_date }} - {{ order.theme_title }}</td>
					<td>{{ order.company.name }}</td>
					<td>{{ order.created_at }}</td>
					<td>
						<div class="ui mini basic icon buttons">
							<a href="#" class="ui button"><i class="eye icon"></i></a>
							<a href="#" class="ui button"><i class="edit icon"></i></a>
							<button class="ui button"><i class="trash icon"></i></button>
						</div>
					</td>
				</tr>
			</tbody>
		</table>
	</div>
</template>

<script>
    export default {
    	data: function () {
    		return {
    			orders: []
    		}
    	},

    	methods: {

    	},

        mounted() {
            console.log('Admin Order index Component mounted.');
        },

        created() {
        	var vm = this;
            var route = '/admin/orders';
        	axios.get(route).then(function (response) {
        		vm.orders = response.data;
        		// vm.loading = false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>