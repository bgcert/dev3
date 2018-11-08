<template>
	<div class="segment">
		<h3>Заявки</h3>

		<table class="dashboard">
			<thead>
				<tr>
					<th>Изпратена на:</th>
					<th>Относно</th>
					<th>Подател</th>
					<th></th>
				</tr>
			</thead>
			<tbody v-for="(contact, index) in contacts">
				<tr :class="{ active: !contact.read }">
					<td>{{ contact.created_at }}</td>
					<td>
						<router-link :to="'/contacts/' + contact.id">
							{{ contact.about }}
						</router-link>
					</td>
					<td>{{ contact.from }}</td>
					<td>
						<div class="ui mini basic icon buttons">
							<router-link :to="'/contacts/' + contact.id" class="ui button">
								<i class="eye icon"></i>
							</router-link>
							<button class="btn small" @click.prevent="handleDelete(contact.id, index)">
								Изтриване
							</button>
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