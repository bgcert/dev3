<template>
	<div>
		<table class="table table-bordered" v-if="users.length > 0">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Име</th>
					<th scope="col">Фирма</th>
					<th scope="col">E-mail</th>
					<th scope="col">Регистриран на</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="user in users" :class="{ 'table-danger': !user.verified }">
					<th scope="row">{{ user.id }}</th>
					<td>{{ user.full_name }}</td>
					<td>
						<template v-if="user.role_id == 2">
							<a :href="'/c/' + user.company.slug" target="_blank">{{ user.company.name }}</a>
						</template>
					</td>
					<td>{{ user.email }}</td>
					<td>{{ user.created_at }}</td>
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
    			users: []
    		}
    	},

    	methods: {

    	},

        mounted() {
            console.log('Users index Component mounted.');
        },

        created() {
        	var vm = this;
            var route = '/admin/users';
        	axios.get(route).then(function (response) {
        		vm.users = response.data;
        		// vm.loading = false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>