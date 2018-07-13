<template>
	<mu-container>
		<mu-dialog :title="title" width="600" max-width="80%" :esc-press-close="false" :overlay-close="false" :open.sync="openAlert">
			{{ content }}
			<mu-button slot="actions" flat color="primary" @click="confirm">{{ submitText }}</mu-button>
			<mu-button slot="actions" flat color="primary" @click="cancel">{{ cancelText }}</mu-button>
		</mu-dialog>
	</mu-container>
</template>

<script>
	export default {
		props: ['title', 'content', 'submitText', 'cancelText'],
    	data: function () {
    		return {
    			openAlert: false,
    			resolve: null
    		}
    	},

    	methods: {
    		pop() {
		        // this.active = true;
		        return new Promise(function(resolve, reject){
		            resolve = this.resolve;
		        });
		    },
    		confirm () {
    			this.openAlert = false;
    			this.resolve(true);
    			//this.$emit('confirm');
    		},
    		cancel () {
    			this.openAlert = false;
    			this.resolve(false);
    			//this.$emit('cancel');
    		}
    	},

    	mounted() {
            console.log('Modal Component mounted.')
        },

        created() {
        	this.pop().then( function() {
        		console.log('resolved');
        	});
		}
    };
</script>

<style>
</style>