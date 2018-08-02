<template>
    <div class="messenger">
    	<div class="threads">
    		<div>
    			<h3>Messenger: {{ owner.full_name }}</h3>
    			<!-- Search -->
    			<div class="ui fluid icon input">
    				<input type="text" placeholder="Search..." v-model="searchInput">
    				<i class="close icon"></i>
    			</div>

    			<button class="ui basic button" @click="clearSearch()">clear</button>

    			<!-- Search searchResults -->
    			<div v-if="searchResults.length > 0">
    				<div class="ui middle aligned selection list">
    					<h4>Search results</h4>
	    				<div class="item" v-for="result in searchResults" @click.prevent="selectUser(result)">
	    					<img class="ui avatar image" :src="result.picture">
	    					<div class="content">
	    						<div class="header" >{{ result.full_name }}</div>
	    					</div>
	    				</div>
	    			</div>
    			</div>
    		</div>

    		<!-- Thread list -->
    		<div v-if="activeThread != {}">
    			<h4>Conversations</h4>
    			<div class="ui middle aligned selection list" >
    				<div class="item" v-for="thread in filteredThreads" :class="{ selected: (activeThread.id == thread.id) }" @click.prevent="setThread(thread)">
    					<img class="ui avatar image" :src="thread.first_participant.user.picture">
    					<div class="content">
    						<div class="header" >{{ thread.first_participant.user.full_name }}</div>
    						<div class="description">{{ thread.last_message.body }} at {{ thread.last_message.updated_at }}</div>
    					</div>
    				</div>
    			</div>
    		</div>

    	</div>

    	<div class="feed-box">
    		<!-- Feed participant -->
    		<div class="header" v-if="activeParticipant.id">
    			<h4> Participant: {{ activeParticipant.full_name }}</h4>
    		</div>
    		<div class="conversation" v-if="messages.length > 0">

	    		<div class="ui feed">
	    			<template v-for="message in messages">
		    			<!-- if current user -->
		    			<div class="event reverse" v-if="message.user_id == owner.id">
				    			<div class="label">
				    				<img :src="owner.picture">
				    			</div>
				    			<div class="content" style="text-align: right;">
				    				<p>
				    					{{ message.body }}
				    				</p>
				    				<div v-if="!message.local && activeThread.first_participant.read_message_id == message.id">
			    						<i class="small check circle outline icon"></i>
			    					</div>
				    			</div>
		    			</div>
		    			<!-- if not current user -->
		    			<div class="event" v-else>
		    				<div class="label">
			    				<img :src="activeParticipant.picture">
			    			</div>
			    			<div class="content">
			    				<p>
			    					{{ message.body }}
			    				</p>
			    			</div>
		    			</div>
		    		</template>
		    	</div>
	    	</div>
	    	<div class="conversation" v-else></div>
	    		
    		<!-- Message input -->
    		<div class="message-box">
    			<div class="ui form">
	    			<div class="field">
	    				<input
	    					name="message"
	    					v-model="messageText"
	    					@keyup.enter="send"
	    					@focus="seen"
	    					placeholder="Write a message ...">
	    				</input>
	    			</div>
	    		</div>
    		</div>
    	</div>
    </div>
</template>

<script>
    export default {
    	props: ['owner'],

    	data: function () {
    		return {
    			test: false,
    			loading: false,
    			threadList: [],
    			filteredThreads: [],
    			messages: [],
    			activeThread: {},
    			activeParticipant: {},
    			searchInput: '',
    			searchResults: [],
    			messageText: '',
    			lastMessageIsRead: false,
    			focusOnSearch: false
    		}
    	},

  //   	computed: {
		// 	threads: function () {
		// 		return (this.filteredThreads.length > 0) ? this.filteredThreads : this.threadList;
		// 	}
		// },

    	methods: {
    		allThreadsByCurrentUser() {
    			return new Promise( function(resolve, reject) {
	    			axios.get('/msgr/threads')
		    			.then(function (response) {
						    resolve(response.data);
						})
						.catch(function (error) {
						    console.log(error);
						    reject('user threads not loaded');
						})
				});
    		},

    		setThread(thread) {
    			let vm = this;
    			this.activeThread = thread;
	    		this.activeParticipant = thread.first_participant.user;
    		},

    		getMessages(id) {
				let vm = this;
    			axios.get('/msgr/thread/' + id + '/messages')
	    			.then(function (response) {
	    				vm.messages = response.data;
					})
					.catch(function (error) {
					    console.log(error);
					})
    		},

    		send() {
    			let vm = this;
    			let route;
    			// Add message
    			if (this.activeThread.id != null) {
	    			route = '/msgr/thread/' + this.activeThread.id + '/message/add';
	    			axios.post(route, {
	    				body: vm.messageText
	    			})
	    			.then(function (response) {
	    				vm.messages.push(response.data);
	    				vm.messageText = '';
	    			})
	    			.catch(function (error) {
	    				console.log(error);
	    			});
	    			return;
	    		}
    			
				// New message
    			route = '/msgr/thread/message/new';
    			axios.post(route, {
    				user_id: vm.activeParticipant.id,
    				body: vm.messageText
    			})
    			.then(function (response) {
    				vm.threadList.unshift(response.data);
    				vm.setThread(response.data);
    				vm.messageText = '';
    			})
    			.catch(function (error) {
    				console.log(error);
    			});

    			
    		},

    		searchUsers() {
    			let vm = this;
    			axios.post('/msgr/search', {
    				text: vm.searchInput
    			})
    			.then(function (response) {
    				vm.filterThreads();
    				// vm.filterResults(response.data);
    				vm.searchResults = response.data;
    			})
    			.catch(function (error) {
    				console.log(error);
    			});
    		},

    		searchAfterDebounce: _.debounce(
	            function () {
	                this.searchUsers()
	            }, 800 // 800 milliseconds
	        ),

	        clearSearch() {
	        	this.searchInput = '';
	        	this.filteredThreads = this.threadList;
	        	this.searchResults = [];
	        },

    		selectUser(user) {
    			this.messages = [];
				this.activeParticipant = user;
    			this.activeThread = { id: null };
    			this.clearSearch();
    		},

    		filterThreads() {
    			let vm = this;
    			let result = this.threadList.find( function(thread) {
    				return thread.first_participant.user.full_name.toLowerCase().includes(vm.searchInput);
    			});
    			if (result) {
    				this.filteredThreads = [];
    				this.filteredThreads.push(result);
    			}
    		},

    		seen() {
    			if (this.activeThread.id == null) {
    				return;
    			}
    			let vm = this;
    			if (!this.lastMessageIsRead) {
    				let route = '/msgr/thread/seen';
	    			axios.post(route, {
	    					thread_id: vm.activeThread.id,
	    					read_message_id: vm.messages[vm.messages.length - 1].id // last message id
	    				})
		    			.then(function (response) {
		    				vm.lastMessageIsRead = true;
						    console.log(response.data)
						})
						.catch(function (error) {
						    console.log(error);
						})
    			}
    		},

    		async load() {
    			this.threadList = await this.allThreadsByCurrentUser();
    			this.filteredThreads = this.threadList;

    			// This will run after previous is fully loaded!
    			if (this.threadList.length > 0) {
    				this.setThread(this.threadList[0]);
    			}
    		}
    	},

    	watch: {
		    activeThread: function (val) {
		    	if (val.id != null) {
		    		this.getMessages(val.id);
		    	}
		    },

		    searchInput: function (val) {
		    	if (val.length > 2) {
		    		this.searchAfterDebounce();
		    	}
		    }
		},

        mounted() {
            console.log('Messenger mounted.');
            this.load();
        },

        created() {
        	Echo.private('messages.' + this.owner.id)
                	.listen('NewMessage', (e) => {
                		console.log(e.message.thread_id);
                		if (e.message.thread_id == this.activeThread.id) {
                			this.messages.push(e.message)
                		}
                });

            Echo.private('threads.' + this.owner.id)
                	.listen('NewThread', (e) => {
                		console.log('new thread');
                		let route = 'msgr/thread/' + e.thread_id;
			        	axios.get(route)
			        		.then((response) => {
			        			this.threadList.unshift(response.data);
			        		});
                });
        }
    };
</script>

<style lang="scss">
	.reverse {
		flex-direction: row-reverse !important;
	}

	.messenger {
		display: flex;
		height: calc(100vh - 100px);

		.threads {
			padding: 20px;
			border-right: 1px solid grey;
			flex: 1;

			.content .description {
				font-weight: normal;
				font-style: italic;
			}

			.selected {
				background-color: rebeccapurple !important;
				font-weight: bold;
				.content {

					.header {
						color: white;
					}

					.description {
						color: white;	
					}
				}
			}
		}

		.feed-box {
			flex: 2;
			background-color: white;
			display: flex;
   			flex-direction: column;
   			justify-content: center;

   			.header {
   				border-bottom: 1px solid grey;
   				padding: 15px;
   			}

   			.conversation {
   				flex: 1 1 0%;
   				padding: 15px;
   			}

			.message-box {
				padding: 15px;
				border-top: 1px solid grey;
			}
		}

		.details {
			flex: 1;
			background-color: green;
		}
	}
</style>