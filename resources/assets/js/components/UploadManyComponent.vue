<template>
	<div>
		<div v-for="(image, index) in images">
			<div
				class="images"
				:style="{
							'background-image': 'url(' + image.url + ')',
							'background-position': 'center center'
						}">
			</div>
			<el-progress :percentage="image.progress"></el-progress>
			<button class="ui basic button" @click.prevent="remove(index)">Remove</button>
		</div>
		<div>
			<label for="files" class="ui small icon button cover" ><i class="camera icon"></i> Добави</label>
			<input type="file" name="files" id="files" class="inputfile" @change="onFileChange">
		</div>
	</div>
</template>

<script>
	import { EventBus } from '../app';
    export default {
    	props: {
    		img: String
    	},

    	data: function () {
    		return {
    			selectedFiles: [],
    			images: [],
    			file: null,
    		}
    	},

    	methods: {
    		onFileChange(e) {
    			this.selectedFiles.push(event.target.files[0]);
    			let vm = this;

    			var files = e.target.files || e.dataTransfer.files;
    			var imageUrl = URL.createObjectURL(files[0]);
    			this.images.push({ 'url': imageUrl, 'progress': 0 });

				this.file = files[0];
    		},

    		remove(index) {
    			this.images.splice(index, 1);
    			this.selectedFiles.splice(index, 1);
    			this.file = null;
    			console.log(index + ' removed');
    		},
    		uploadImage(file, index) {
    			let vm = this;
    			return new Promise(resolve => {
    				let formData = new FormData();
    				formData.append('file', file);
	    			axios.post('dashboard/image/upload', formData, {
	    				onUploadProgress: progressEvent => {
	    					vm.images[index].progress =  Math.round( (progressEvent.loaded * 100) / progressEvent.total );
	    				}
	    			})
	    			.then(function (responce) {
	    				resolve(responce.data);
	    			})
	    			.catch(function (error) {
	    				console.log(error);
	    			})
    			});
    		},

    		async imageList() {
    			let images = [];
    			let arr = this.selectedFiles;
        		for (var i = 0, len = arr.length; i < len; i++) {
					let x = await this.uploadImage(arr[i], i);
					images.push(x);
				}
				return images;
    		}
    	},

        mounted() {
            console.log('UploadMany component mounted.');
        },

        created() {
        	EventBus.$on('imageSaveMany', (resolve, reject) => {
        		resolve(this.imageList());
        	});
        },

        destroyed() {
			EventBus.$off('imageSave');
		}
    };
</script>

<style>
	.cover { margin: 10px; }

	.images {
		padding: 7px;
		background-size: cover;
		position: relative;
		width: 357px;
		height: 178px;
	}

	.inputfile {
		width: 0.1px;
		height: 0.1px;
		opacity: 0;
		overflow: hidden;
		position: absolute;
		z-index: -1;
	}

	.inputfile + label {
		font-size: 1.25em;
		font-weight: 700;
		color: white;
		background-color: black;
		display: inline-block;
	}

	.inputfile:focus + label,
	.inputfile + label:hover {
		background-color: red;
	}
</style>