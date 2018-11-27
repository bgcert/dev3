<template>
	<div class="card">

		<div class="card-header d-flex justify-content-between align-items-center">
			Заявки
			<router-link to="/orders/create" class="btn btn-primary btn-sm disabled">
				<i class="far fa-plus-square"></i> Въведи заявка
			</router-link>
		</div>
		<div class="card-body" v-loading="loading">

			<table class="table">
				<thead>
					<tr>
						<th>Изпратена на:</th>
						<th>Тема/Дата</th>
						<th><i class="fas fa-users"></i></th>
						<th>Статус</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(order, index) in orders" :class="{ 'bg-warning': !order.read_at }">
						<th>{{ order.created_at }}</th>
						<td>
							<router-link :to="'/orders/' + order.id">
								{{ order.event_start_date }} - {{ order.theme_title }}
							</router-link>
						</td>
						<td>{{ order.participants_count }}</td>
						<td>
							<button class="btn btn-secondary btn-sm" :class="{ 'btn-success': order.status == 1, 'btn-warning': order.status == 2, 'btn-danger': order.status == 3 }">
								{{ statusText(order.status) }}
							</button>
						</td>
						<td>
							<div class="btn-group">
								<router-link :to="'/orders/' + order.id" class="btn btn-outline-secondary btn-sm">
									<i class="far fa-edit"></i>
								</router-link>
								<button class="btn btn-outline-danger btn-sm" @click.prevent="handleDelete(order.id, index)">
									<i class="far fa-trash-alt"></i>
								</button>
							</div>
						</td>
					</tr>
				</tbody>
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
    		handleDelete(id, index) {
    			let vm = this;
    			var result = confirm('Сигурни ли сте, че желаете да изтриете заявката?');
			    if (result) {
			    	axios.delete('dashboard/orders/' + id).then( function (response) {
	    				vm.orders.splice(index, 1);
	    			});
			    } else {
			        console.log('canceled');
			    }
    		},

    		statusText: function (status) {
		    	if(status == 1) {
		    		return 'Платена'
		    	} else if(status == 2) {
		    		return 'Потвърдена'
		    	} else if(status == 3) {
		    		return 'Отказана'
		    	} else {
		    		return 'Необработена'
		    	}
			}
    	},

        mounted() {
            console.log('Orders index mounted.');
        },

        created() {
        	var vm = this;
            var route = '/dashboard/orders';
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