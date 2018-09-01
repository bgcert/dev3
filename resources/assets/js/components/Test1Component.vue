<template>
	<div>
		<div class="single-image" :style="'background-image: url(' + existingImage.filename + ');'">
			<label for="files" class="ui small purple icon button" ><i class="camera icon"></i> Качи изображение</label>
			<input type="file" id="files" class="inputfile" @change="onFileChange">
			<div class="progress" v-if="existingImage.progress >= 0">
				<el-progress :text-inside="true" :stroke-width="18" :percentage="existingImage.progress" color="rgba(142, 113, 199, 0.7)"></el-progress>
			</div>
		</div>
		<button class="ui basic button" @click.prevent="upload">upload</button>
	</div>
</template>

<script>
	// import { EventBus } from '../app';
    export default {

    	data: function () {
    		return {
    			existingImage: { 'filename': null, 'progress': -1 },
    			item: null
    		}
    	},

    	methods: {

    	},

        mounted() {

        },

        created() {
        	
        }
    };
</script>

<style>
	
</style>