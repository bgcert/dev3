<template>
	<div>
		<table class="table table-bordered" v-if="contacts.length > 0">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Изпратено на:</th>
					<th scope="col">Фирма</th>
					<th scope="col">Подател</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="contact in contacts" :class="{ 'table-danger': contact.read_at == null }">
					<th scope="row">{{ contact.id }}</th>
					<td>{{ contact.created_at }}</td>
					<td>{{ contact.company.name }}</td>
					<td>{{ contact.from }}</td>
					<td>
						<div class="btn-group btn-group-sm" role="group" aria-label="Basic example">
							<button type="button" class="btn btn-outline-secondary"><i class="eye icon"></i></button>
							<button type="button" class="btn btn-outline-secondary"><i class="edit icon"></i></button>
							<button type="button" class="btn btn-outline-secondary"><i class="trash icon"></i></button>
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
    			contacts: []
    		}
    	},

    	methods: {

    	},

        mounted() {
            console.log('Users index Component mounted.');
        },

        created() {
        	var vm = this;
            var route = '/admin/contacts';
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