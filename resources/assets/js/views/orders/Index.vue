<template>
	<div class="segment">
		<div class="aligned">
			<h3>Заявки</h3>	
			<router-link to="/orders/create" class="btn blue">
				Въведи заявка
			</router-link>
		</div>
		<div v-loading="loading">
			<table class="dashboard">
				<thead>
					<tr>
						<th>Получена на:</th>
						<th>Дата/Тема</th>
						<th><i class="user icon"></i></th>
						<th>Статус</th>
						<th></th>
					</tr>
				</thead>
				<tbody v-for="(order, index) in orders">
					<tr :class="{ active: !order.read }">
						<td>{{ order.created_at }}</td>
						<td>
							<router-link :to="'/orders/' + order.id">
								{{ order.event_start_date }} - {{ order.theme_title }}
							</router-link>
						</td>
						<td>{{ order.participants_count }}</td>
						<td>
							<div
								class="ui mini horizontal label"
								:class="{ green: order.status == 1, orange: order.status == 2, red: order.status == 3 }">
								{{ statusText(order.status) }}
							</div>
						</td>
						<td>
							<div class="ui mini basic icon buttons">
								<router-link :to="'/orders/' + order.id" class="ui button">
									<i class="edit icon"></i>
								</router-link>
								<button class="btn small" @click.prevent="handleDelete(order.id, index)">
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