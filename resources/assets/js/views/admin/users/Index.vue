<template>
	<div>
			<table class="ui selectable celled small table"  v-if="users.length > 0">
				<thead>
					<tr>
						<th>#ID</th>
						<th>Име</th>
						<th>Фирма</th>
						<th>E-mail</th>
						<th>Status</th>
						<th>Регистриран на:</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="user in users">
						<td>{{ user.id }}</td>
						<td>{{ user.full_name }}</td>
						<template v-if="user.role_id == 2">
							<td><a href="#">{{ user.company.name }}</a></td>
						</template>
						<template v-else>
							<td></td>
						</template>
						<td>{{ user.email }}</td>
						<td v-if="user.token == null">Активиран</td>
						<td v-else>Деактивиран</td>
						<td>{{ user.created_at }}</td>
						<td>
							<div class="ui mini basic icon buttons">
								<a href="#" class="ui button"><i class="eye icon"></i></a>
								<a href="#" class="ui button"><i class="edit icon"></i></a>
								<button class="ui button"><i class="trash icon"></i></button>
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