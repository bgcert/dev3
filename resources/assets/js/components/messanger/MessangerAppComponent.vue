<template>
	<div>
		<div class="ui segment messanger">
			<thread-list :threads="threads" :selected="selectedThread"></thread-list>
			<messages-feed></messages-feed>
		</div>
	</div>
</template>

<script>
	import { EventBus } from '../../app';
    export default {

    	data: function () {
    		return {
    			selectedThread: null,
    			threads: []
    		}
    	},

        methods: {

        },

        mounted() {
            console.log('Messanger App Component mounted.')
        },

        created() {
        	axios.get('threads')
        		.then((response) => {
        			//console.log(response.data);
        			this.threads = response.data;
        			this.selectedThread = response.data[0];
        		});
        }
    };
</script>

<style>
	.messanger {
		display: flex;
		height: 600px;
	}
</style>