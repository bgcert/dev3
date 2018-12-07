<template>
	<div>
		<button type="button" class="btn btn-primary">Предстоящи</button>
		<button type="button" class="btn btn-secondary">Всички</button>
		<hr>
		<table class="table table-bordered" v-if="events.length > 0">
			<thead>
				<tr>
					<th scope="col">#</th>
					<th scope="col">Тема</th>
					<th scope="col">Начална дата</th>
					<th scope="col">Фирма</th>
					<th scope="col">Потребител</th>
					<th scope="col">Регистриран на</th>
					<th scope="col"></th>
				</tr>
			</thead>
			<tbody>
				<tr v-for="event in events">
					<th scope="row">{{ event.id }}</th>
					<td>{{ event.theme.title }}</td>
					<td>{{ event.start_date_carbon }}</td>
					<td>{{ event.theme.company.name }}</td>
					<td>{{ event.theme.company.user.full_name }}</td>
					<td>{{ event.created_at }}</td>
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