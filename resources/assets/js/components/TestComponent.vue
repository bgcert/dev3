<template>
	<div>
		<image-upload
			v-for="instance in instances"
			:index="instance"
			:key="instance"
			:imageUrl="'/test/image1.jpg'"
			:route="'/dashboard/venue/image/upload'">
		</image-upload>
		<button class="ui basic button" @click.prevent="add">add</button>
		<button class="ui basic button" @click.prevent="upload">upload</button>
	</div>
</template>

<script>
	import { EventBus } from '../app';
    export default {

    	data: function () {
    		return {
    			instances: 3
    		}
    	},

    	methods: {
    		add () {
		      this.instances++;
		    },
	    	upload() {
				let promise = new Promise((resolve, reject) => EventBus.$emit('upload', resolve, reject));
				return promise;
    		}
    	},

        mounted() {

        },

        created() {
        	
        }
    };
</script>

<style>
	
</style>