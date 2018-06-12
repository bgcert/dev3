<template>
	<div class="feed-container">
		<h1>Messages feed</h1>
		<div  class="messages-feed" ref="feed">
			<ul>
				<li v-for="message in messages" :class=" { 'message sent': message.user.id != 1, 'message received': message.user.id == 1 }">
					<div class="text">
	                    {{ message.body }}
	                </div>
				</li>
			</ul>	
		</div>
		
		<textarea v-model="input" @keydown.enter.prevent="send" placeholder="Message..."></textarea>
	</div>
</template>

<script>
	import { EventBus } from '../../app';
    export default {
    	// props: ['thread'],

    	data: function () {
    		return {
    			thread: null,
    			messages: [],
    			input: ''
    		}
    	},

        methods: {
        	send() {
        		if (!this.thread) {
        			return;
        		}

                if (this.input == '') {
                    return;
                }

                axios.post('message/add', {
                	thread: this.thread,
                    input: this.input
                }).then((response) => {
                	this.input = '';
                	this.messages.push(response.data);
                });
            },

            scrollToBottom() {
                setTimeout(() => {
                    this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
                }, 100);
            }
        },

        watch: {
            thread: function () {
                this.scrollToBottom();
            },
            messages: function () {
                this.scrollToBottom();
            }
        },

        mounted() {
            console.log('Conversation Component mounted.')
        },

        created() {
        	EventBus.$on('selected', id => {
        		if (this.input != '') {
        			this.input = '';
        		}
        		this.thread = id;
				let route = 'thread/' + id;
	        	axios.get(route)
	        		.then((response) => {
	        			this.messages = response.data.messages;
	        		});
			});
        }
    };
</script>

<style lang="scss" scoped>

.feed-container {
	flex: 5;
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
    max-height: 470px;
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

::-webkit-scrollbar {
    width: 0px;  /* remove scrollbar space */
    background: transparent;  /* optional: just make scrollbar invisible */
}
</style>
