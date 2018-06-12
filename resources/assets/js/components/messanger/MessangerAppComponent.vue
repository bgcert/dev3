<template>
	<div>
		<div class="ui segment messanger">
			<threadList></threadList>
			<messagesFeed></messagesFeed>
		</div>
	</div>
</template>

<script>
	import threadList from './ThreadListComponent';
    import messagesFeed from './MessagesFeedComponent';
	import { EventBus } from '../../app';
    export default {
    	components: { threadList, messagesFeed },

    	data: function () {
    		return {

    		}
    	},

        methods: {

        },

        mounted() {
            console.log('Messanger App Component mounted.');

            Echo.private('messages')
                .listen('NewMessage', () => {
                    // this.hanleIncoming(e.message);
                    console.log('message sent');
                });
        },

        created() {
        	
        }
    };
</script>

<style>
	.messanger {
		display: flex;
		height: 600px;
	}
</style>