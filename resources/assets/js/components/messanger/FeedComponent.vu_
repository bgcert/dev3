<template>
	<div>
		<template v-if="thread">
			<div class="ui feed">
				<template v-for="message in thread.messages">
					<div class="event">
						<div class="label">
							<el-tooltip class="item" effect="dark" :content="message.user.name" placement="left">
								<img :src="message.user.picture">
							</el-tooltip>
						</div>
						<div class="content">
							<el-tooltip class="item" effect="dark" :content="message.updated_at" placement="top">
								<div class="ui left pointing large label" v-bind:class="{ blue: isAuthUser(message.user.id) }">
									{{ message.body }}
								</div>
							</el-tooltip>
						</div>
					</div>
				</template>
					<div class="event">
						<div class="summary">
							<div class="date">
								<i class="clock outline icon"></i> Видяно в 00:00 ч.
							</div>
						</div>
					</div>
				<div class="ui form">
					<div class="inline fields">
						<div class="twelve wide field">
							<textarea rows="2" v-model="message"></textarea>
						</div>
						<div class="four wide field">
							<button class="ui circular icon button" @click="send"><i class="paper plane outline icon"></i></button>		
						</div>
					</div>
					
				</div>
			</div>
		</template>
	</div>
</template>

<script>
	import { EventBus } from '../../app';
    export default {
    	props: ['id'],

    	data: function () {
    		return {
    			thread_id: '',
    			thread: [],
    			message: ''
    		}
    	},

        mounted() {
            console.log('Message Feed Component mounted.');
        },

        methods: {
        	loadThread(id)
        	{
        		var vm = this;
	        	axios.post('/users/thread', { id: id }).then(function (response) {
	        		vm.thread = response.data;
	        		console.log(response.data);
				})
				.catch(function (error) {
					console.log(error);
				});
        	},

        	isAuthUser(id) {
        		return (id == this.id);
        	},

        	send() {
        		var vm = this;
	        	axios.post('/users/message', { user_id: vm.id, thread: vm.thread_id, message: vm.message }).then(function (response) {
	        		vm.thread.messages.push(response.data);
	        		console.log(response.data);
	        		vm.message = '';
				})
				.catch(function (error) {
					console.log(error);
				});
        	}
        },

        created() {
        	var vm = this;
        	// Listen for the i-got-clicked event and its payload.
			EventBus.$on('setThread', function (id) {
				vm.thread_id = id;
				vm.loadThread(id);
			});
        }
    }
</script>