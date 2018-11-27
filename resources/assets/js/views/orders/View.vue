<template>
	<div class="card">
		<div class="card-header">
			Заявка от {{ order.contact_person }} 
		</div>

		<div class="card-body">
			<h4>{{ order.theme_title }} - {{ order.event_start_date }}</h4>

			<table class="table">
				<thead>
					<tr>
						<th>Регистрирана на:</th>
						<th>Ед. цена</th>
						<th>Участници</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>{{ order.created_at }}</td>
						<td>{{ order.event_price }}.00 лв.</td>
						<td>{{ order.participants_count }}</td>
					</tr>
				</tbody>
				<tfoot>
					<tr>
						<th></th>
						<th><h4>Общо:</h4></th>
						<th><h4>{{ order.event_price * order.participants_count }}.00 лв.</h4></th>
					</tr>
				</tfoot>
			</table>

			<table class="table">
				<thead>
					<tr>
						<th colspan="2">Контакти</th>
					</tr>
				</thead>
				<tbody>
					<tr>
						<td>Лице за контакти</td>
						<td>{{ order.contact_person }}</td>
					</tr>
					<tr>
						<td>Телефон</td>
						<td>{{ order.contact_number }}</td>
					</tr>
					<tr>
						<td>E-mail</td>
						<td>{{ order.contact_email }}</td>
					</tr>
				</tbody>

				<template v-if="order.invoice == 1 && order.details != null">
					<thead>
						<tr>
							<th colspan="2">Данни за фактура</th>
						</tr>
					</thead>
					<tbody>
						<tr>
							<td>Организация</td>
							<td>{{ order.details.organization }}</td>
						</tr>
						<tr>
							<td>ЕИК</td>
							<td>{{ order.details.cid }}</td>
						</tr>
						<tr>
							<td>ДДС номер</td>
							<td>{{ order.details.vat }}</td>
						</tr>
						<tr>
							<td>Адрес</td>
							<td>{{ order.details.address }}</td>
						</tr>
						<tr>
							<td>МОЛ</td>
							<td>{{ order.details.owner }}</td>
						</tr>
					</tbody>
				</template>
			</table>

			<table class="table col-6" v-if="order.id">
				<thead>
					<tr>
						<th>Списък на участниците</th>
					</tr>
				</thead>
				<tbody v-for="(participant, index) in order.participants">
					<tr>
						<td>{{ (index+1) + '. ' + participant.name }}</td>
					</tr>
				</tbody>
			</table>

			<hr>
			
			<div class="form-group col-6">
				<label>Статус</label>
				<select class="custom-select" v-model="order.status">
					<option v-for="item in options" :value="item.value">{{ item.label }}</option>
				</select>
			</div>

			<div class="form-group col-6">
				<label>Записки (видими от организатора)</label>
				<textarea class="form-control" rows="3" v-model="order.note"></textarea>
			</div>

			<div class="text-right">
				<router-link to="/orders" class="btn btn-link">
					Назад
				</router-link>
				<button class="btn btn-outline-secondary btn-sm" @click.prevent="markAsUnread" :class="{ disabled: order.read_at == null }"> Маркирай като непрочетена</button>
				<button class="btn btn-danger btn-sm" @click="save">Запиши</button>
		    </div>

		</div>
	</div>
</template>

<script>
    export default {
    	data: function () {
    		return {
    			options: [{
    				value: 0,
    				label: 'Необработена'
    			},{
    				value: 1,
    				label: 'Платена'
    			}, {
    				value: 2,
    				label: 'Потвърдена'
    			}, {
    				value: 3,
    				label: 'Отказана'
    			}],
    			order: {}
    		}
    	},

    	methods: {
    		save() {
    			let vm = this;
    			let route = '/dashboard/orders/' + this.$route.params.id;
    			axios.patch(route, { status: vm.order.status, note: vm.order.note  })
	    			.then(function (response) {
	    				vm.$router.push('/orders');
					})
					.catch(function (error) {
						console.log(error);
					});
    		},

    		markAsUnread() {
    			let vm = this;
    			axios.post('/dashboard/orders/unread', { id: vm.order.id  })
	    			.then(function (response) {
	    				vm.order.read_at = null;
	    				vm.$notify({
				        	message: 'Статусът е променен.',
				        	type: 'success'
				        });
					})
					.catch(function (error) {
						console.log(error);
					});
    		},
    	},

        mounted() {
            // console.log('Orders create mounted.');

            var vm = this;
            var route = '/dashboard/orders/' + this.$route.params.id;
        	axios.get(route).then(function (response) {
        		vm.order = response.data;
        		// vm.status = response.data.status;
        		// vm.loading = false;
			})
			.catch(function (error) {
				console.log(error);
			});
        },

        created() {

        }
    };
</script>