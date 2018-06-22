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

			<table class="ui sortable celled table">
				<thead>
					<tr>
						<th>#</th>
						<th>Получена на:</th>
						<th>Дата/Тема</th>
						<th>Статус</th>
					</tr>
				</thead>
				<tbody v-for="order in orders">
					<tr>
						<td>{{ order.id }}</td>
						<td>{{ order.created_at }}</td>
						<td>{{ order.begin_at }} - {{ order.title }}</td>
						<td><div class="ui green horizontal label">Платена</div></td>
					</tr>
				</tbody>
				<tfoot>
					<tr><th>3 People</th>
						<th>2 Approved</th>
						<th></th>
						<th></th>
					</tr></tfoot>
				</table>
		</div>
	</div>
</template>

<script>
    export default {
    	data: function () {
    		return {
    			loading: false,
    			orders: [],
    		}
    	},

    	methods: {

    	},

        mounted() {
            console.log('Orders index mounted.');
        },

        created() {
        	var vm = this;
            var route = '/dashboard/orders';
        	axios.get(route).then(function (response) {
        		console.log(response.data);
        		vm.orders = response.data;
        		// vm.loading = false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>