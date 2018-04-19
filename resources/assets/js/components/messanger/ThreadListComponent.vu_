<template>
	<div>
		<div class="ui large relaxed list">
			<template v-for="thread in threads">
				<div class="item" v-bind:class="{ selected: selected == thread.id }">
					<img class="ui avatar image" :src="thread.first_participant.user.picture">
					<div class="content">
						<a href="#" @click.prevent="setThread(thread.id)" class="header">{{ thread.first_participant.user.name }}</a>
						<div class="description">{{ thread.last_message.user_name + thread.last_message.body }} {{ thread.last_message.updated_at }}</div>
					</div>
				</div>
			</template>
		</div>
	</div>
</template>

<script>
	import { EventBus } from '../../app';
    export default {
    	props: ['auth_id'],

    	data: function () {
    		return {
    			threads: [],
    			selected: ''
    		}
    	},

        mounted() {
            console.log('Thread List Component mounted.');
        },

        methods: {
        	setThread(id) {
			    // Send the event on a channel (i-got-clicked) with a payload (the click count.)
			    this.selected = id;
			    EventBus.$emit('setThread', id);
        	}
        },

        created() {
        	var vm = this;
        	axios.post('/users/threads', { auth_id: vm.auth_id }).then(function (response) {
        		vm.threads = response.data;
        		vm.setThread(vm.threads[0].id); // set last thread as default in FeedComponent.vue
			})
			.catch(function (error) {
				console.log(error);
			});
        }
    }
</script>

<style>
	.selected {
		background-color: #f6f7f9;
	}
</style>