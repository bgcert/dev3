export default {
    state: {
    	userId: null,
    	threads: [],
    	messages: [],
    	contact: [],
    	selectedThread: null,
    	contactIsNew: false,
    	searchResults: []
    },

    getters: {
    	userId(state) { return state.userId; },
        threads(state) { return state.threads; },
        contact(state) { return state.contact; },
        contactIsNew(state) { return state.contactIsNew; },
        messages(state) { return state.messages; },
        selectedThread(state) { return state.selectedThread; },
        searchResults(state) { return state.searchResults; },
    },

    mutations: {

    	updateThreads(state, payload) {
    		state.threads = payload[0];
    		state.userId = payload[1];
    	},

    	updateMessages(state, payload) {
    		state.messages = payload;
    	},

    	updateSelectedThread(state, payload) {
    		state.selectedThread = payload;
    	},

    	updateContact(state, payload) {
    		state.contact = payload;
    	},

    	updateContactIsNew(state, payload) {
    		state.contactIsNew = payload;
    	},

    	updateSearchResults(state, payload) {
    		state.searchResults = payload;
    	},

    	unshiftThread(state, payload) {
    		state.threads.unshift(payload);
    	},

    	pushMessage(state, payload) {
    		state.messages.push(payload);
    	},

    	// updateSeen(state, payload) {
    	// 	console.log(payload);
    	// 	console.log('seen');
    	// },

    	clearSearchResults(state) {
    		state.searchResults = [];
    	}
    },

    actions: {
    	async load(context, contact_id) {
			// Load all existing threads
    		await context.dispatch('getThreads');

    		// Listening for new threads and messages
    		context.dispatch('listen');
    		// if no threads -> return
    		if (context.getters.threads.length == 0) {
    			return;
    		}

    		let thread = [];
    		// Check if contact id is set
    		if (contact_id) {
    			// if is set, check if a thread with this contact exist
    			let result = await context.dispatch('existingContact', contact_id);
    			if (result) {
    				// if exist, select coresponding thread
    				thread = result;
    			} else {
    				// else get the new contact
    				let contact = await context.dispatch('getContact', contact_id);
    				context.commit('updateContact', contact);
    			}
    		} else {
    			// if not, select last thread
    			thread = context.state.threads[0];
    			await context.dispatch('selectThread', thread);
    		}
    		
    		context.dispatch('getMessages', context.getters.selectedThread);
    	},

    	selectThread(context, thread) {
        	return new Promise((resolve, reject) => {    			
	        	context.commit('updateContact', thread.first_participant.user);
	        	context.commit('updateSelectedThread', thread.id);
	        	context.dispatch('getMessages', thread.id);
	        	resolve();
        	})
        },

    	existingContact(context, id) {
    		return new Promise((resolve, reject) => {
	    		var result = context.state.threads.filter(function(array) { 
				    return array.first_participant.user.id == id;
				});

				if (result.length > 0) {
					resolve(result[0]);	
				} else {
					context.commit('updateContactIsNew', true);

					console.log('a new contact');
					resolve(null);
				}
			})
    	},

    	getContact(context, id) {
    		return new Promise((resolve, reject) => {
	    		let route = 'messages/contact/' + id;
	    		axios.get(route)
	    			.then((response) => {
	    				resolve(response.data)
	                });
            })
    	},

    	newThread(context) {
        	return new Promise((resolve, reject) => {
	        	axios.post('messages/new', {
		                	to: context.getters.contact.id,
		                }).then((response) => {
		                	context.commit('unshiftThread', response.data);
		                	resolve(response.data.id)
		                });
	        })
        },

    	// toUser(context, id) {
    	// 	let vm = this;
    	// 	let route = 'messages/contact/' + id;
    	// 	axios.get(route)
    	// 		.then((response) => {
    	// 			console.log(response.data);
     //            	context.commit('updateContact', response.data);
     //            	context.commit('updateSelectedThread', null);
     //            });
    	// },

    	getThreads(context) {
    		return new Promise((resolve, reject) => {
	    		axios.get('messages/threads')
	        		.then((response) => {
	        			context.commit('updateThreads', response.data);
	        			resolve()
	        		})
	        		.catch((error) => {
	        			reject(error);
	        		})
    		})
        },

        getMessages(context, id) {
        	return new Promise((resolve, reject) => {
	        	let route = 'messages/thread/' + id;
	        	axios.get(route)
	        		.then((response) => {
	        			context.commit('updateMessages', response.data.messages);
	        			resolve()
	        		});
        	})
        },



        listen(context) {
        	Echo.private('messages.' + context.getters.userId)
                	.listen('NewMessage', (e) => {
                		if (e.message.thread_id == context.getters.selectedThread) {
                			context.commit('pushMessage', e.message);
                		}
                });

            Echo.private('threads.' + context.getters.userId)
                	.listen('NewThread', (e) => {
                		let route = 'messages/thread/' + e.thread_id;
			        	axios.get(route)
			        		.then((response) => {
			        			response.data.unread = true;
			        			context.commit('unshiftThread', response.data);
			        		});
                });
        },

        async newContact(context) {
        	let id = await context.dispatch('newThread');
        	context.commit('updateSelectedThread', id);
        },

        sendMessage(context, message) {
        	axios.post('messages/add', {
                	thread_id: context.getters.selectedThread,
                    input: message
                }).then((response) => {
                	context.commit('pushMessage', response.data);
                });
        },

        seen(context) {
        	axios.post('messages/seen', {
                	thread_id: context.getters.selectedThread,
                }).then((response) => {
                	context.commit('updateSeen', response.data);
                });
        },

        search(context, input) {
	        	axios.post('messages/user/search', { searchQuery: input })
	        		.then(function (response) {
	        			context.commit('updateSearchResults', response.data);
					})
					.catch(function (error) {
						console.log(error);
					});
		}
    }
}