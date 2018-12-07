<template>
	<div>
		<table class="table table-bordered" v-if="orders.length > 0">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Заявил</th>
					<th scope="col">Събитие</th>
					<th scope="col">Фирма</th>
					<th scope="col">Регистриран на</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="order in orders" :class="{ 'table-danger': order.read_at == null }">
					<th scope="row">{{ order.id }}</th>
					<td>{{ order.contact_person }}</td>
					<td>{{ order.event_start_date }} - {{ order.theme_title }}</td>
					<td>{{ order.company.name }}</td>
					<td>{{ order.created_at }}</td>
					<td>
						<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
							<button type="button" class="btn btn-outline-secondary"><i class="eye icon"></i></button>
							<button type="button" class="btn btn-outline-secondary"><i class="edit icon"></i></button>
							<button type="button" class="btn btn-outline-secondary"><i class="trash icon"></i></button>
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