<template>
	<div>
		<div class="ui segment messanger">
			<div class="threads">

				<!-- Search -->
				<form class="ui form">
					<div class="field">
						<input type="text" name="first-name" placeholder="Намери потребител" v-model="searchInput" @focus="focus = true" @blur="focus = false">
					</div>
				</form>
				<div class="ui active centered inline small loader" v-show="loading"></div>

				<div class="ui middle aligned selection list" v-for="item in searchResults">
					<div class="item" @click.prevent="newUser(item)">
						<img class="ui avatar image" :src="item.picture">
						<div class="content">
							<div class="header">{{ item.name }}</div>
						</div>
					</div>
				</div>

				<!-- Thread List -->
				<ul v-show="!focus && (searchInput == '')">
					<li v-for="thread in threads" @click.prevent="selectThread(thread.id)" :class="{ 'selected': thread.id == selectedThread }">
						<router-link :to="'/t/' + thread.id">
							<div class="picture">
								<img :src="thread.first_participant.user.picture">
							</div>
							<div class="details">
								<p class="name">{{ thread.first_participant.user.name }}</p>
								<p v-if="thread.last_message">{{ thread.last_message.body }}</p>
							</div>
						</router-link>
					</li>
				</ul>
			</div>

			<!-- Messages Feed -->
			<div class="feed-container">
				<div class="ui divided items" v-if="selectedUser">
					<div class="item">
						<div class="ui tiny circular image">
							<img :src="selectedUser.picture">
						</div>
						<div class="middle aligned content">
							{{ selectedUser.name }}
						</div>
					</div>
				</div>

				<div  class="messages-feed" ref="feed">
					<ul>
						<li v-for="message in messages" :class=" { 'message sent': message.sent == userId, 'message received': message.sent != userId }">
							<div class="text">
			                    {{ message.body }}
			                </div>
						</li>
					</ul>	
					<textarea v-model="input" @keydown.enter.prevent="send" placeholder="Message..."></textarea>
				</div>
			</div>
		</div>
	</div>
</template>

<script>
	import _ from 'lodash'; // Don't know why is not imported already.
	import { EventBus } from '../../app';
    export default {

    	data: function () {
    		return {
    			focus: false,
    			loading: false,
    			userId: null,
    			selected: null,
    			selectedUser: null,
    			input: '',
    			searchInput: '',
    			newMessage: false
    		}
    	},

    	computed: {
    		threads: function() {
    			return this.$store.getters.threads;
    		},
    		messages: function() {
    			return this.$store.getters.messages;
    		},
    		selectedThread: function() {
    			return this.$store.getters.selectedThread;
    		},
    		searchResults: function() {
    			return this.$store.getters.searchResults;
    		}
    	},

        methods: {
        	newUser(item) {
        		this.searchQuery = '';
				var exist = this.threads.filter(function(arr) { 
				    return arr.first_participant.user.id == item.id; 
				});

				if (exist.length == 0) {
					this.newMessage = true;
					this.selectedUser = item;
	        		this.messages = [];
	        		this.selected = null;
	        		return;
				}

				this.selectThread(exist[0].id);
        	},

        	selectThread(id = null) {
        		if (this.threads.length == 0) return;

        		if (id == null) {
        			id = this.threads[0].id; // id is the first thread
        			this.$router.push('/t/' + id);
        		}

        		this.$store.commit('selectThread', id);
        		this.$store.dispatch('getMessages', id);

	        	Echo.private('messages.' + this.selected)
                .listen('NewMessage', (e) => {
                    this.hanleIncoming(e.message);
                });
        	},

        	send() {
                if (this.input == '') {
                    return;
                }

                this.$store.dispatch('sendMessage', this.input);

                if (this.newMessage) {
					axios.post('messages/new', {
	                	to: this.selectedUser.id,
	                    input: this.input
	                }).then((response) => {
	                	this.newMessage = false;
	                	this.input = '';
	                	//this.threads.unshift(response.data[0]);
	                	this.messages = response.data[1];
	                	this.selectThread(response.data[0].id);
	                	// this.selected = response.data[0].id;
	                	console.log();
	                });
	                return;               	
                }

                // axios.post('messages/add', {
                // 	thread_id: this.selected,
                //     input: this.input
                // }).then((response) => {
                // 	this.input = '';
                // });
            },

            hanleIncoming(message) {
            	this.pushMessage(message);
            	// console.log(message.sent);
            },

            pushMessage(message) {
            	this.messages.push(message);
            },

            scrollToBottom() {
                setTimeout(() => {
                    this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
                }, 100);
            },

            searchAfterDebounce: _.debounce(
	            function () {
	                this.search()
	            }, 800 // 800 milliseconds
	        ),

    		search() {
    			this.$store.dispatch('search', this.searchInput);
    		},
        },

        watch: {
            selected: function () {
                this.scrollToBottom();
            },
            messages: function () {
                this.scrollToBottom();
            },
            searchInput: function (val) {
	        	if (val.length > 2) {
	        		this.loading = true;
	        		this.searchAfterDebounce();
	        	} else {
	        		this.$store.commit('clearSearchResults');
	        	}
	        }
        },

        mounted() {
            console.log('Messanger App Component mounted.');
            let id = (this.$route.params.id) ? this.$route.params.id : null;
            this.$store.dispatch('getThreads').then((id) => {
            	console.log('test');
            	this.selectThread(id);
				//this.$store.dispatch('getFirstThread', id);
			});
			//this.$store.dispatch('getFirstThread', id);
        },

        created() {        	
        	let id = (this.$route.params.id) ? this.$route.params.id : null;
        	let vm = this;     	
        }
    };
</script>

<style lang="scss" scoped>
	.messanger {
		display: flex;

		.threads {
		    flex: 2;
		    overflow-y: scroll;
		    border-right: 1px solid #a6a6a6;
		    
		    ul {
		        list-style-type: none;
		        padding-left: 0;
		        li {
		        	&.selected {
		                background: #e9ebee;
		            }
		        }
		        li a {
		            display: flex;
		            padding: 2px;
		            border-bottom: 1px solid #f1f1f1;
		            height: 80px;
		            position: relative;
		            cursor: pointer;
		            .picture {
		                flex: 1;
		                display: flex;
		                align-items: center;
		                img {
		                    width: 35px;
		                    border-radius: 50%;
		                    margin: 0 auto;
		                }
		            }
		            .details {
		                flex: 3;
		                font-size: 14px;
		                overflow: hidden;
		                display: flex;
		                flex-direction: column;
		                justify-content: center;
		                p {
		                    margin: 0;
		                    &.name {
		                        font-weight: bold;
		                    }
		                }
		            }
		        }
		    }
		}

		.feed-container {
			flex: 5;
		}

		.ui.divided.items {
			border-bottom: 1px solid #e9ebee;
			margin: 0;
			padding: 10px;
		}

		textarea {
		    width: 96%;
		    margin: 10px;
		    resize: none;
		    border-radius: 3px;
		    border: 1px solid lightgray;
		    padding: 6px;
		}

		.messages-feed {
		    height: 100%;
		    //max-height: 470px;
		    overflow-y: scroll;
		    ul {
		        list-style-type: none;
		        padding: 5px;
		        li {
		            &.message {
		                margin: 10px 0;
		                width: 100%;
		                .text {
		                    max-width: 200px;
		                    border-radius: 5px;
		                    padding: 12px;
		                    display: inline-block;
		                }
		                &.received {
		                    text-align: right;
		                    .text {
		                        background: #b2b2b2;
		                        color: #fff;
		                    }
		                }
		                &.sent {
		                    text-align: left;
		                    .text {
		                        background: #81c4f9;
		                    }
		                }
		            }
		        }
		    }
		}
	}

	::-webkit-scrollbar {
	    width: 0px;  /* remove scrollbar space */
	    background: transparent;  /* optional: just make scrollbar invisible */
	}
</style>