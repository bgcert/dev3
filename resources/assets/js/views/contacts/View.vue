<template>
	<div class="ui segments">
		<div class="ui clearing segment">
			<h4 style="float: left;">От: {{ contact.from }}</h4>
		</div>
		<div class="ui clearing segment" v-if="contact.id">
			<div class="ten wide column">
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
								<p>{{ contact.body }}</p>
							</td>
						</tr>
					</tbody>
				</table>
				<div class="right floated">
					<span class="ui right floated basic segment">
						<a href="#/contacts" class="item router-link-active">
							<div class="ui basic button">Назад</div>
				    	</a>
						<div class="ui basic primary button" @click="markAsUnread" :class="{ disabled: !read }"> Маркирай като непрочетено</div>
						<div class="ui negative button"> Изтрий</div>
					</span>
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