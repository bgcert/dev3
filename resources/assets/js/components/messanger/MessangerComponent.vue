<template>
	<div>
		<header>
			<div class="container">
				<div class="left" style="position: absolute; top: 24%;">
					<div class="ui circular blue icon button"><i class="paper plane outline icon"></i></div>
				</div>

				<div class="middle">
					<h3>{{ thread.first_participant.user.name }}</h3>
					<!-- <p>Messenger</p> -->
				</div>

				<div class="right">
					<div class="username">
						<div class="settings">
							<img src="/img/messanger/settings.svg">
						</div>
						{{ name }}
					</div>
					<div class="avatar">
						<img :src="picture">
					</div>
				</div>
			</div>
		</header>

		<main>
			
			<div class="col-left">
		        <div class="col-content">
		            <div class="messages">
		            	<template v-for="thread in threads">
			                <li v-bind:class="{ selected: selected == thread.id }">
			                	<a href="#" @click.prevent="loadThread(thread.id)">
			                		<div class="avatar">
				                        <div class="avatar-image">
				                            <div class="status online"></div>
				                            <img :src="thread.first_participant.user.picture">
				                        </div>
				                    </div>
				                    <h3>{{ thread.first_participant.user.name }}</h3>
				                    <p>{{ thread.last_message.user_name + thread.last_message.body }} {{ thread.last_message.updated_at }}</p>	
			                	</a>
			                </li>
		                </template>
		            </div>
		        </div>
		    </div>

		    <div class="col">

		        <div class="col-content">
		            <section class="message">
		                <div class="grid-message">
		                	<template v-if="thread">
		                		<template v-for="message in thread.messages">
		                			<template v-if="message.user.id == auth_id">
				                		<div class="col-message-sent">
				                			<el-tooltip class="item" effect="dark" :content="message.updated_at" placement="left">
					                        	<div class="message-sent">
					                            	<p>{{ message.body }}</p>
					                        	</div>
					                    	</el-tooltip>
					                    </div>
									</template>
									<template v-else>
										<div class="col-message-received">
											<el-tooltip class="item" effect="dark" :content="message.updated_at" placement="right">
					                        	<div class="message-received">
					                            	<p>{{ message.body }}</p>
					                        	</div>
					                    	</el-tooltip>
					                    </div>
									</template>
			                    </template>
		                	</template>
		                </div>
		            </section>
		        </div>

		        <div class="col-foot">
		            <div class="compose">

		                <input placeholder="Напишете съобщение" v-model="message">
		                <div class="compose-dock">
		                    <div class="dock">
		                    	<button class="ui circular icon button" @click="send"><i class="paper plane outline icon"></i></button>
		                    </div>
		                </div>
		            </div>
		        </div>

		    </div>

		    <div class="col-right">

		        <div class="col-content">

		            <div class="user-panel">
		                <div class="avatar">
		                    <div class="avatar-image">
		                        <div class="status online"></div>
		                        <img :src="thread.first_participant.user.picture">
		                    </div>

		                    <h3>{{ thread.first_participant.user.name }}</h3>
		                    <p>London, United Kingdom</p>
		                </div>
		            </div>
		        </div>

		    </div>
		</main>
	</div>
</template>

<script>
	import { EventBus } from '../../app';
    export default {
    	props: ['auth_id', 'name', 'picture'],

    	data: function () {
    		return {
    			threads: [],
    			thread: [],
    			selected: '',
    			message: ''
    		}
    	},

        mounted() {
            console.log('Messanger Component mounted.');
        },

        methods: {

        	loadThread(id)
        	{
        		this.selected = id;
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
	        	axios.post('/users/message', { user_id: vm.auth_id, thread: vm.selected, message: vm.message }).then(function (response) {
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
        	axios.post('/users/threads', { auth_id: vm.auth_id }).then(function (response) {
        		vm.threads = response.data;
        		vm.loadThread(vm.threads[0].id); // set last thread as default in FeedComponent.vue
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