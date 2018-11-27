<template>
	<div class="card">
		<div class="card-header">
			От: {{ contact.from }}
		</div>

		<div class="card-body" v-if="contact.id">
			
			<table class="table">
				<tbody>
					<tr>
						<th>Изпратено на:</th>
						<td>{{ contact.created_at }}</td>
					</tr>
					<tr>
						<th>Относно:</th>
						<td>{{ contact.about }}</td>
					</tr>
					<tr>
						<th>Лице за контакти:</th>
						<td>{{ contact.from }}</td>
					</tr>
					<tr>
						<th>E-mail:</th>
						<td>{{ contact.email }}</td>
					</tr>
					<tr>
						<th>Телефон: </th>
						<td>{{ contact.phone }}</td>
					</tr>
					<tr>
						<th>Заглавие: </th>
						<td>{{ contact.subject }}</td>
					</tr>
					<tr>
						<td colspan="2">
							<p>{{ contact.body }}</p>
						</td>
					</tr>
				</tbody>
			</table>

			<div class="text-right">
		    	<router-link to="/contacts" class="btn btn-link">
					Назад
				</router-link>
				<button class="btn btn-outline-secondary btn-sm" @click.prevent="markAsUnread" :class="{ disabled: contact.read_at == null }"> Маркирай като непрочетено</button>
				<button class="btn btn-danger btn-sm" @click.prevent="handleDelete(contact.id)"> Изтрий</button>
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
    			contact: {},
    			read_at: true
    		}
    	},

    	methods: {
    		markAsUnread() {
    			let vm = this;
    			axios.post('/dashboard/contacts/unread', { id: vm.contact.id  })
	    			.then(function (response) {
	    				vm.contact.read_at = null;
	    				vm.$notify({
				        	message: 'Статусът е променен.',
				        	type: 'success'
				        });
					})
					.catch(function (error) {
						console.log(error);
					});
    		},

    		handleDelete(id) {
    			let vm = this;
    			var result = confirm('Сигурни ли сте, че желаете да изтриете запитването?');
			    if (result) {
			    	axios.delete('dashboard/contacts/' + id).then( function (response) {
	    				window.location.href = '/dashboard#/contacts';
	    			});
			    } else {
			        console.log('canceled');
			    }
    		}
    	},

        mounted() {
            console.log('Contacts create mounted.');

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