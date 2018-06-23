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
						<th>Получена на:</th>
						<th>Дата/Тема</th>
						<th><i class="user icon"></i></th>
						<th>Статус</th>
						<th></th>
					</tr>
				</thead>
				<tbody v-for="order in orders">
					<tr>
						<td>{{ order.created_at }}</td>
						<td>
							<router-link :to="'/orders/' + order.id">
								{{ order.event.begin_at }} - {{ order.event.theme.title }}
							</router-link>
						</td>
						<td>{{ order.participants_count }}</td>
						<td><div class="ui mini green horizontal label">Платена</div></td>
						<td>
							<div class="ui mini basic icon buttons">
								<router-link :to="'/orders/' + order.id" class="ui button">
									<i class="edit icon"></i>
								</router-link>
								<router-link :to="'/orders/' + order.id + '/delete'" class="ui button">
									<i class="trash icon"></i>
								</router-link>
							</div>
						</td>
					</tr>
				</tbody>
					<tfoot>
						<tr><th>3 People</th>
							<th>2 Approved</th>
							<th></th>
							<th></th>
							<th></th>
						</tr>
					</tfoot>
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