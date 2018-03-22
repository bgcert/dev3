<template>
	<div>
		<template v-if="events[1]">
			<table class="table table-bordered">
				<tr>
					<td>#ID</td>
					<td>{{ events[1].id }}</td>
					
				</tr>
				<tr>
					<td>Name</td>
					<td><a :href="'/event/' + events[1].id">{{ events[1].theme.title }}</a></td>
				</tr>
				<tr>
					<td>cover</td>
					<td><img :src="events[1].cover" style="width: 200px;"></td>
				</tr>
				<tr>
				<td>Body</td>
					<td>{{ events[1].theme.body }}</td>
				</tr>
				<tr>
					<td>Begin at:</td>
					<td>{{ events[1].begin_at }}</td>
				</tr>
				<tr>
					<td>Organization</td>
					<td><a :href="'/c/' + events[1].theme.company.slug">{{ events[1].theme.company.name }}</a></td>
				</tr>
				<tr>
					<td></td>
					<td><a href="#">Request</a></td>
				</tr>
				<tr>
					<td></td>
					<td>
						<like
							:auth="auth"
							:likes="(events[1].theme.like_count != null) ? events[1].theme.like_count.count : ''"
							:liked="events[1].theme.is_liked.length"
							:item_id="events[1].id"
							:route="'/users/like/theme'"
							>
						</like>
					</td>
				</tr>
			</table>
		</template>
	</div>
</template>

<script>
    export default {
    	props: ['auth'],
    	data: function () {
    		return {
    			events: {},
    		}
    	},

    	methods: {

    	},

        mounted() {
            console.log('event list Component mounted.')
        },

        created() {
        	var vm = this;
        	axios.get('/eventlist').then(function (response) {
        		vm.events = response.data;
				console.log(vm.events);
			})
			.catch(function (error) {
				console.log(error);
			});
    	}
    }
</script>