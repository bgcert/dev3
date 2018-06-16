export default {
    state: {
    	msg: 'Hello',
    	userId: null,
    	threads: [],
    	messages: [],
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
    },
    mutations: {
    	updateThreads(state, payload) {
    		state.threads = payload[0];
        	state.userId = payload[1];
    	},

    	updateMessages(state, payload) {
    		state.messages = payload;
    	},

    	updateSearchResults(state, payload) {
    		state.searchResults = payload;
    	}
    },
    actions: {
    	getThreads(context) {
    		axios.get('messages/threads')
        		.then((response) => {
        			context.commit('updateThreads', response.data);
        		})
        		.catch((error) => {
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