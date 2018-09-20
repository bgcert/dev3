<template>
	<div class="ui segments">
		<div class="ui clearing segment">
			<h3 style="float: left;">Заявки</h3>
		</div>
		<div class="ui segment" v-loading="loading" style="min-height: 200px;">

			<table class="ui sortable celled table">
				<thead>
					<tr>
						<th>Получена на:</th>
						<th>Относно</th>
						<th><i class="user icon"></i></th>
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
									<i class="edit icon"></i>
								</router-link>
								<button class="ui button" @click.prevent="handleDelete(contact.id, index)">
									<i class="trash icon"></i>
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
	    				vm.orders.splice(index, 1);
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