<template>
	<div class="ui segments">
		<div class="ui clearing segment">
			<h3 style="float: left;">Заявка {{ order.id }}</h3>
		</div>
		<div class="ui segment" v-if="order.id">
			<div class="ui grid">
				<div class="ten wide column">
					<h4>{{ order.theme_title }} - {{ order.event_start_date }}</h4>
					<table class="ui table">
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

						<table class="ui celled table">
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

					<table class="ui collapsing table">
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

					<div class="ui form">
						<div class="field">
							<label>Записки (видими от организатора)</label>
							<textarea></textarea>
						</div>
					</div>
				</div>
  				<div class="six wide column">
  					<div class="ui secondary segment">
  						<el-select v-model="value" placeholder="Статус">
	  						<el-option
	  							v-for="item in options"
	  							:key="item.value"
	  							:label="item.label"
	  							:value="item.value">
	  						</el-option>
	  					</el-select>
	  					<button class="ui small basic button" @click="setStatus">Промени</button>
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
    			options: [{
    				value: 1,
    				label: 'Платена'
    			}, {
    				value: 2,
    				label: 'Потвърдена'
    			}, {
    				value: 3,
    				label: 'Отказана'
    			}],
    			value: null,
    			order: {}
    		}
    	},

    	methods: {
    		setStatus() {
    			let vm = this;
    			axios.post('/dashboard/orders/status', { order: vm.order.id, status: vm.value  }).then(function (response) {
    				vm.$notify({
			        	message: 'Статусът е променен.',
			        	type: 'success'
			        });
				})
				.catch(function (error) {
					console.log(error);
				});
    		}
    	},

        mounted() {
            // console.log('Orders create mounted.');

            var vm = this;
            var route = '/dashboard/orders/' + this.$route.params.id;
        	axios.get(route).then(function (response) {
        		vm.order = response.data;
        		vm.value = response.data.status;
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