<template>
	<div>

		<div class="ui unstackable items">
			<template v-for="event in events">
				<div class="item">
					<a :href="'/event/' + event.id" class="image">
						<img :src="'https://d3cwccg7mi8onu.cloudfront.net/fit-in/250x250/' + event.cover">	
					</a>
					<div class="content">
						<a :href="'/event/' + event.id" class="header">{{ event.theme.title }}</a>
						<div class="meta">
							<span>{{ event.begin_at }}</span>
						</div>
						<div class="extra">
							Прегледан 123 пъти
						</div>
					</div>
				</div>
			</template>
		</div>

	</div>
</template>

<script>
	import { EventBus } from '../app';
    export default {
    	props: ['auth', 'company_id'],

    	data: function () {
    		return {
    			events: {}
    		}
    	},

    	methods: {

    		request(id) {
    			EventBus.$emit('testlog', 'some message');
    			console.log('request ' + id);
    		}
    	},

        created() {
            var vm = this;
        	axios.post('/api/relatedeventlist', { company_id: vm.company_id}).then(function (response) {
        		vm.events = response.data;
        		console.log('event list');
				console.log(vm.events);
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    };
</script>