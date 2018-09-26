<template>
	<div>
			<table class="ui selectable celled table"  v-if="users.length > 0">
				<thead>
					<tr>
						<th>#ID</th>
						<th>Име</th>
						<th>Фирма</th>
						<th>E-mail</th>
						<th>Status</th>
						<th>Notes</th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="user in users">
						<td>{{ user.id }}</td>
						<td>{{ user.firstname }} {{ user.lastname }}</td>
						<template v-if="user.user_id == 2">
							<a href="#">{{ user.company.name }}</a>
						</template>
						<template v-else>
							<td></td>
						</template>
						<td>{{ user.firstname }} {{ user.lastname }}</td>
						<td>{{ user.email }}</td>
						<td v-if="user.token == null">Активиран</td>
						<td v-else>Деактивиран</td>

					</tr>
<!-- 					<tr>
						<td>Jamie</td>
						<td>Approved</td>
						<td>Requires call</td>
					</tr>
					<tr>
						<td>Jill</td>
						<td>Denied</td>
						<td>None</td>
					</tr>
					<tr class="warning">
						<td>John</td>
						<td>No Action</td>
						<td>None</td>
					</tr>
					<tr>
						<td>Jamie</td>
						<td class="positive">Approved</td>
						<td class="warning">Requires call</td>
					</tr>
					<tr>
						<td>Jill</td>
						<td class="negative">Denied</td>
						<td>None</td>
					</tr> -->
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