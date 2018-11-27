<template>
	<div class="card">
		<div class="card-header">
			Съобщения
		</div>

		<div class="card-body">
			<table class="table table-bordered">
				<thead>
					<tr>
						<th>Изпратена на:</th>
						<th>Относно</th>
						<th>От</th>
						<th>Изтриване</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="(contact, index) in contacts" :class="{ 'bg-warning': !contact.read_at }">
						<td>
							{{ contact.created_at }}
						</td>
						<td>
							<router-link :to="'/contacts/' + contact.id">
								{{ contact.about }}
							</router-link>
						</td>
						<td>
							{{ contact.from }}
						</td>
						<td>
							<div class="btn-group">
								<router-link :to="'/contacts/' + contact.id" class="btn btn-outline-secondary btn-sm">
									<i class="fas fa-eye"></i>
								</router-link>
								<button class="btn btn-outline-danger btn-sm" @click.prevent="handleDelete(contact.id, index)">
									<i class="far fa-trash-alt"></i> Изтриване
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
    			contacts: [],
    		}
    	},

    	methods: {
    		handleDelete(id, index) {
    			let vm = this;
    			var result = confirm('Сигурни ли сте, че желаете да изтриете запитването?');
			    if (result) {
			    	axios.delete('dashboard/contacts/' + id).then( function (response) {
	    				vm.contacts.splice(index, 1);
	    			});
			    } else {
			        console.log('canceled');
			    }
    		}
    	},

        mounted() {
            console.log('Orders index mounted.');
        },

        created() {
        	var vm = this;
            var route = '/dashboard/contacts';
        	axios.get(route).then(function (response) {
        		vm.contacts = response.data;
        		// vm.loading = false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>