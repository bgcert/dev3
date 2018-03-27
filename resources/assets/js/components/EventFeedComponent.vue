<template>
	<div>
		<request-modal
			auth="1"
			>
		</request-modal>
		<div v-for="event in events">
			
			<table class="table table-bordered">
				<tr>
					<td>#ID</td>
					<td>{{ event.id }}</td>
				</tr>
				<tr>
					<td>Name</td>
					<td>
						<a :href="'/event/' + event.id">{{ event.theme.title }}</a>
					</td>
				</tr>
				<tr>
					<td>cover</td>
					<td><img :src="event.cover" style="width: 200px;"></td>
				</tr>
				<tr>
				<td>Body</td>
					<td>{{ event.theme.body }}</td>
				</tr>
				<tr>
					<td>Begin at:</td>
					<td>{{ date(event.begin_at) }}</td>
				</tr>
				<tr>
					<td>Organization</td>
					<td>
						<box-hover :name="event.theme.company.name" :id="event.theme.company.id"></box-hover>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<a href="#" @click.prevent="request(event.id)">Reqeust</a>
					</td>
				</tr>
				<tr>
					<td></td>
					<td>
						<like
							:auth="auth"
							:likes="(event.theme.like_count != null) ? event.theme.like_count.count : ''"
							:liked="event.theme.is_liked.length"
							:item_id="event.theme.id"
							:route="'/users/like/theme'"
							>
						</like>
					</td>
				</tr>
			</table>
		</div>	
	</div>
</template>

<script>
	import { EventBus } from '../app';
    export default {
    	props: ['auth'],

    	data: function () {
    		return {
    			events: {}
    		}
    	},

    	methods: {
    		date(date) {
    			return moment(date).format('D MMM YYYY');
    		},

    		request(id) {
    			EventBus.$emit('testlog', 'some message');
    			console.log('request ' + id);
    		}
    	},

        created() {
            var vm = this;
        	axios.get('/data/eventlist').then(function (response) {
        		vm.events = response.data;
        		console.log('event list');
				console.log(vm.events);
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    }
</script>