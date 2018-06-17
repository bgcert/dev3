export default {
    state: {
    	threads: [],
    	messages: [],
    	contact: [],
    	selectedThread: null,
    	searchResults: []
    },

    getters: {
    	welcome(state) { return state.msg; },
        threads(state) { return state.threads; },
        contact(state) { return state.contact; },
        messages(state) { return state.messages; },
        selectedThread(state) { return state.selectedThread; },
        searchResults(state) { return state.searchResults; },
    },

    mutations: {
    	updateThreads(state, payload) {
    		state.threads = payload[0];
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

    	updateSearchResults(state, payload) {
    		state.searchResults = payload;
    	},

    	unshiftThread(state, payload) {
    		state.threads.unshift(payload);
    	},

    	pushMessage(state, payload) {
    		state.messages.push(payload);
    	},

    	clearSearchResults(state) {
    		state.searchResults = [];
    	}
    },

    actions: {
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
        	let route = 'messages/thread/' + id;
        	axios.get(route)
        		.then((response) => {
        			context.commit('updateMessages', response.data.messages);
        		});
        },

        selectThread(context, thread) {
        	context.commit('updateContact', thread.first_participant.user);
        	context.commit('updateSelectedThread', thread.id);
        },

        listen(context) {
        	Echo.private('messages.' + context.getters.selectedThread)
                	.listen('NewMessage', (e) => {
                	context.commit('pushMessage', e.message);
                });
        },

        async newContact(context) {
        	let id = await context.dispatch('newThread');
        	console.log(id);
        	context.commit('updateSelectedThread', id);
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

        sendMessage(context, message) {
        	axios.post('messages/add', {
                	thread_id: context.getters.selectedThread,
                    input: message
                }).then((response) => {
                	context.commit('pushMessage', response.data);
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