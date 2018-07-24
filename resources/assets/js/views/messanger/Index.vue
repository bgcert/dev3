<template>
	<div>
		<div class="messanger">
			<div class="threads">
				<div class="search">
					<input type="test" name="search" placeholder="Намери потребител" v-model="searchInput" @focus="focus = true" @blur="focus = false">
				</div>
				<div class="ui active centered inline small loader" v-show="loading"></div>

				<div class="ui middle aligned selection list" v-for="item in searchResults">
					<div class="item" @click.prevent="newUser(item)">
						<img class="ui avatar image" :src="item.picture">
						<div class="content">
							<div class="header">{{ item.full_name }}</div>
						</div>
					</div>
				</div>

				<div
					v-show="!focus && (searchInput == '')"
					v-for="thread in threads"
					@click.prevent="selectThread(thread)"
					:class="{ 'selected': thread.id == selectedThread, 'unread': thread.unread }">

					<router-link :to="'/t/' + thread.id" class="item">
						<div class="avatar">
							<img :src="thread.first_contact.user.picture">
						</div>
						<div class="info">
							<div class="name">
								{{ thread.first_contact.user.full_name }}
							</div>
							<div class="last-message">
								{{ thread.last_message.body }}
							</div>
						</div>
						<div class="details">
							<div class="tools"></div>
							<div class="sent">5 min</div>
						</div>
					</router-link>
				</div>
			</div>
			<div class="feed">
				<div class="header" v-if="contact">
					{{ contact.full_name }}
				</div>
				<div class="messages" v-for="message in messages">
					<div class="item"  :class="{ 'sent': message.sent == userId, 'received': message.sent != userId }">
						<div class="avatar" v-if="message.sent != userId">
							<img :src="contact.picture">
						</div>
						<div class="message">
							{{ message.body }}
						</div>
					</div>
				</div>
				<div class="input-box">
					<input type="text" name="new-message" placeholder="Въведете съобщение" v-model="input" @keydown.enter.prevent="(contactIsNew) ? newMessage() : send()">
					<div>
						<button @click.prevent="(contactIsNew) ? newMessage() : send()">Send</button>
					</div>
				</div>
			</div>
			<div class="details">
				<div class="header" v-if="contact">
					<div class="avatar">
						<img :src="contact.picture">
					</div>
					<div class="name">
						{{ contact.full_name}}
					</div>
				</div>
				
				<div class="company" v-if="contact.company != null">
					<div class="logo">
						<img :src="contact.company.company_detail.logo">
					</div>
					<div class="name">
						{{ contact.company.name }}
					</div>
					<div class="city">
						Sofia, Bulgaria
					</div>
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
    			input: '',
    			searchInput: '',
    		}
    	},

    	computed: {
    		userId: function() {
    			return this.$store.getters.userId;
    		},
    		threads: function() {
    			return this.$store.getters.threads;
    		},
    		contact: function() {
    			return this.$store.getters.contact;
    		},
    		messages: function() {
    			return this.$store.getters.messages;
    		},
    		selectedThread: function() {
    			return this.$store.getters.selectedThread;
    		},
    		searchResults: function() {
    			return this.$store.getters.searchResults;
    		},
    		contactIsNew: function() {
    			return this.$store.getters.contactIsNew;
    		}
    	},

        methods: {

        	async newUser(item) {
        		this.searchQuery = '';

        		let exist = await this.$store.dispatch('existingContact', item.id);

				this.$store.commit('updateContact', item);
				this.$store.commit('updateMessages', []);
				this.$store.commit('updateSelectedThread', null);
				this.searchInput = '';
				// this.isNew = true;
        	},

        	selectThread(thread) {
        		this.$store.dispatch('selectThread', thread);
        	},

        	send() {
                if (this.input == '') return;

                this.$store.dispatch('sendMessage', this.input);
                this.input = '';
            },

            async newMessage() {
            	this.isNew = false;
            	await this.$store.dispatch('newContact');
            	this.send();
            },

            scrollToBottom() {
                setTimeout(() => {
                    this.$refs.feed.scrollTop = this.$refs.feed.scrollHeight - this.$refs.feed.clientHeight;
                }, 300);
            },

            searchAfterDebounce: _.debounce(
	            function () {
	                this.search()
	            }, 800 // 800 milliseconds
	        ),

    		search() {
    			this.$store.dispatch('search', this.searchInput);
    		},

    		async load() {
    			await this.$store.dispatch('load');
    		}
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
	        		this.loading = false;
	        		this.$store.commit('clearSearchResults');
	        	}
	        }
        },

        mounted() {

            console.log('Messanger App Component mounted.');
            this.$store.dispatch('load', this.$route.params.id);
            // if (this.$route.query.contact) {
            // 	this.$store.dispatch('load', this.$route.query.contact);
            // 	this.isNew = true;
            // }
        },

        created() {
        	
        }
    };
</script>

<style lang="scss">

.messanger {
	max-width: 1300px;
	display: flex;
	margin: 0 auto;
}

.threads {
	flex: 3;
	background-color: #282f36;

	.search {
		display: flex;
		align-items: center;
		justify-content: center;
		height: 80px;
		padding: 0 25px;
		border-bottom: 1px solid #41464d;
	}

	input[name=search] {
	    background-color: #363d45;
	    border-radius: 25px;
	    border: none;
	    width: 100%;
	    padding: 15px;
	}

	.item {
		padding: 25px;
		color: #fff;
		display: flex;
		align-items: center;

		.avatar img {
			border-radius: 50%;
			width: 52px;
			height: 52px;
		}

		.info {
			margin-left: 17px;

			.last-message {
				color: #95989c;
				font-size: 0.8rem;
			}
		}

		.details {
			margin-left: 17px;

			.tools:after {
				content: '\00b7\00b7\00b7';
			}

			.sent {
				color: #51575d;
				font-size: 0.8rem;
			}
		}
	}
}

/* Feed */

.feed {
	flex: 5;
	background-color: #edeff3;

	.header {
		display: flex;
		align-items: center;
		height: 80px;
		border-bottom: 1px solid #d5d7da;
		color: #50575d;
		padding-left: 30px;
		font-weight: bold;
	}

	.messages {
		padding: 30px;

		.item {
			display: flex;
			color: #252525;
			font-size: 0.9rem;
			margin-bottom: 20px;

			.avatar img {
				border-radius: 50%;
				width: 36px;
				height: 36px;
			}

			.message {
				background-color: #fff;
				margin-left: 20px;
				padding: 20px;
				border-radius: 4px;
				position: relative;
				max-width: 60%;
			}
		}

		.sent .message:after {
			content: '';
			position: absolute;
			left: 0;
			top: 16px;
			border: 10px solid transparent;
			border-right-color: #fff;
			border-left: 0;
			margin-top: -6px;
			margin-left: -6px;
		}

		.received {
			flex-direction: row-reverse;

			.message {
				background-color: #0084ff;
				margin-right: 20px;
				color: #fff;
			}

			.message:after {
				content: '';
				position: absolute;
				right: 0;
				top: 16px;
				border: 10px solid transparent;
				border-left-color: #0084ff;
				border-right: 0;
				margin-top: -6px;
				margin-right: -6px;
			}
		}
	}

	.input-box {
		background-color: #fbfcfc;
		border-top: 1px solid #e0e3e2;
		height: 80px;
		display: flex;
		align-items: center;
		padding: 0 30px;

		input {
			width: 90%;
			height: 50px;
		}

		button {
			margin-left: 20px;
		}
	}
}

.details {
	flex: 2;
	text-align: center;

	.header {
		height: 80px;
		border-bottom: 1px solid #d5d7da;
		display: flex;
		align-items: center;
		justify-content: center;

		.avatar img {
			border-radius: 50%;
			width: 40px;
			height: 40px;
		}

		.name {
			color: #696e73;
			margin-left: 17px;
		}
	}

	

	.company {
		margin-top: 28px;
		font-size: 1.2rem;
		font-weight: bold;
		color: #293037;

		.logo img {
			margin-top: 30px;
			border-radius: 50%;
			height: 122px;
			width: 122px;
		}

		.name {

		}

		.city {
			color: #696e73;
			font-size: 0.9rem;
		}
	}
}
</style>