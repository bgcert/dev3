<template>
	<div>
			<table class="ui selectable celled small table"  v-if="events.length > 0">
				<thead>
					<tr>
						<th>#ID</th>
						<th>Тема</th>
						<th>Начална дата</th>
						<th>Фирма</th>
						<th>Потребител</th>
						<th>Регистриран на:</th>
						<th></th>
					</tr>
				</thead>
				<tbody>
					<tr v-for="event in events">
						<td>{{ event.id }}</td>
						<td>{{ event.theme.title }}</td>
						<td>{{ event.start_date_carbon }}</td>
						<td>{{ event.theme.company.name }}</td>
						<td>{{ event.theme.company.user.full_name }}</td>
						<td>{{ event.created_at }}</td>
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
    			events: []
    		}
    	},

    	methods: {

    	},

        mounted() {
            console.log('Users index Component mounted.');
        },

        created() {
        	var vm = this;
            var route = '/admin/events';
        	axios.get(route).then(function (response) {
        		vm.events = response.data;
        		// vm.loading = false;
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>