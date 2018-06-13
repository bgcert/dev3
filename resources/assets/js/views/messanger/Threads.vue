<template>
	<div class="threads">
		<ul>
			<li v-for="thread in threads" @click.prevent="selectThread(thread.id)" :class="{ 'selected': thread.id == selectedThread }">
				<router-link :to="'/t/' + thread.id">
					<div class="picture">
						<img :src="thread.first_participant.user.picture">
					</div>
					<div class="details">
						<p class="name">{{ thread.first_participant.user.name }}</p>
						<p>{{ thread.last_message.body }}</p>
					</div>
					<div class="last-message">
						
					</div>	
				</router-link>
			</li>
		</ul>
	</div>
</template>

<script>
	import { EventBus } from '../../app';
    export default {
    	// props: ['threads', 'selected'],

    	data: function () {
    		return {
    			selectedThread: null,
    			threads: []
    		}
    	},

        methods: {
        	selectThread(id) {
        		this.selectedThread = id;
        		EventBus.$emit('selected', id);
        	}
        },

        mounted() {
            console.log('Thread List Component mounted.')
        },

        created() {
        	axios.get('messages/threads')
        		.then((response) => {
        			this.threads = response.data;
        			this.selectThread(response.data[0].id);
        		});
        	//this.selectedThread(this.threads[0].id);
        	// axios.get('threads')
        	// 	.then((response) => {
        	// 		console.log(response.data);
        	// 		//this.threads = response.data;
        	// 	});
        	// EventBus.$on('flash', (message, type) => {
        	// 	this.$message({
        	// 		message: message,
        	// 		type: type
        	// 	});
        	// });
        }
    };
</script>

<style lang="scss" scoped>

.threads {
    flex: 2;
    max-height: 600px;
    overflow-y: scroll;
    border-right: 1px solid #a6a6a6;
    
    ul {
        list-style-type: none;
        padding-left: 0;
        li {
            display: flex;
            padding: 2px;
            border-bottom: 1px solid #f1f1f1;
            height: 80px;
            position: relative;
            cursor: pointer;
            &.selected {
                background: #fff111;
            }
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

::-webkit-scrollbar {
    width: 0px;  /* remove scrollbar space */
    background: transparent;  /* optional: just make scrollbar invisible */
}
</style>