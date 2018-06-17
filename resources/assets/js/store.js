export default {
    state: {
    	userId: null,
    	threads: [],
    	messages: [],
    	selectedThread: null,
    	searchResults: []
    },
    getters: {
    	welcome(state) {
            return state.msg;
        },
        threads(state) {
            return state.threads;
        },
        messages(state) {
            return state.messages;
        },
        selectedThread(state) {
            return state.selectedThread;
        },
        searchResults(state) {
            return state.searchResults;
        },
    },
    mutations: {
    	updateThreads(state, payload) {
    		state.threads = payload[0];
        	state.userId = payload[1];
    	},

    	updateMessages(state, payload) {
    		state.messages = payload;
    	},

    	selectThread(state, payload) {
    		state.selectedThread = payload;
    	},

    	updateSearchResults(state, payload) {
    		state.searchResults = payload;
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
        			//this.selectedUser = response.data.first_participant.user;
        		});
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