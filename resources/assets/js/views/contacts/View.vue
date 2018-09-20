<template>
	<div class="ui segments">
		<div class="ui clearing segment">
			<h4 style="float: left;">От: {{ contact.from }}</h4>
		</div>
		<div class="ui segment" v-if="contact.id">
			<div class="ten wide column">
				<h4></h4>
				<table class="ui collapsing table">
					<tbody>
						<tr>
							<td>Изпратено на: </td>
							<td>{{ contact.created_at }}</td>
						</tr>
						<tr>
							<td>Относно:</td>
							<td>{{ contact.about }}</td>
						</tr>
						<tr>
							<td>Лице за контакти: </td>
							<td>{{ contact.from }}</td>
						</tr>
						<tr>
							<td>E-mail: </td>
							<td>{{ contact.email }}</td>
						</tr>
						<tr>
							<td>Телефон: </td>
							<td>{{ contact.phone }}</td>
						</tr>
						<tr>
							<td>Заглавие: </td>
							<td>{{ contact.subject }}</td>
						</tr>
						<tr>
							<td colspan="2">
								<p>
									{{ contact.body}}
								</p>
							</td>
						</tr>
					</tbody>
				</table>

<!-- 				<div class="ui form">
					<div class="field">
						<label>Записки (видими от организатора)</label>
						<textarea></textarea>
					</div>
				</div> -->
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
    			contact: {}
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
            var route = '/dashboard/contacts/' + this.$route.params.id;
        	axios.get(route).then(function (response) {
        		vm.contact = response.data;
        		// vm.value = response.data.status;
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