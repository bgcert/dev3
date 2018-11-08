<template>
	<div class="segment">
		<h4>От: {{ contact.from }}</h4>
		<div v-if="contact.id">
			<table class="dashboard">
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
							<p>{{ contact.body }}</p>
						</td>
					</tr>
				</tbody>
			</table>
			<div class="field right">
		    	<router-link to="/contacts" class="btn basic">
					Назад
				</router-link>
				<button class="btn basic" @click.prevent="markAsUnread" :class="{ disabled: !read }"> Маркирай като непрочетено</button>
				<button class="btn blue" @click.prevent="handleDelete(contact.id)"> Изтрий</button>
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
    			read: true
    		}
    	},

    	methods: {
    		markAsUnread() {
    			let vm = this;
    			axios.post('/dashboard/contacts/unread', { id: vm.contact.id  })
	    			.then(function (response) {
	    				vm.read = false;
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