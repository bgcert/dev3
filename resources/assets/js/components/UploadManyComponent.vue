<template>
	<div>
		<div v-for="(image, index) in uploadedImages">
			<div
				class="images"
				:style="{
							'background-image': 'url(/photos/vi/' + image.filename + ')',
							'background-position': 'center center'
						}">
			</div>
			<button class="ui small basic button" @click.prevent="detach(index, image.id)">Премахни</button>
		</div>

		<div v-for="(image, index) in images">
			<div
				class="images"
				:style="{
							'background-image': 'url(/photos/vi/' + image.filename + ')',
							'background-position': 'center center'
						}">
			</div>
			<el-progress :percentage="image.progress"></el-progress>
			<button class="ui small basic button" @click.prevent="remove(index)">Премахни</button>
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
    	props: ['images'],

    	data: function () {
    		return {
    			selectedFiles: [],
    			imageList: [],
    			uploadedImages: [],
    			file: null,
    		}
    	},
    	watch: {
    		images: function (val) {
    			return this.uploadedImages = val;
    		}
    	},

    	methods: {
    		onFileChange(e) {
    			this.selectedFiles.push(event.target.files[0]);
    			let vm = this;

    			var files = e.target.files || e.dataTransfer.files;
    			var imageUrl = URL.createObjectURL(files[0]);
    			this.imageList.push({ 'filename': imageUrl, 'progress': 0 });

				this.file = files[0];
    		},

    		remove(index) {
    			this.imageList.splice(index, 1);
    			this.selectedFiles.splice(index, 1);
    			this.file = null;
    		},

    		detach(index, id) {
    			this.uploadedImages.splice(index, 1);
    			this.$emit('detachClick', id);
    		},

    		uploadImage(file, index) {
    			let vm = this;
    			return new Promise((resolve, reject) => {
    				let formData = new FormData();
    				formData.append('file', file);
	    			axios.post('dashboard/venue/image/upload', formData, {
	    				onUploadProgress: progressEvent => {
	    					vm.imageList[index].progress =  Math.round( (progressEvent.loaded * 100) / progressEvent.total );
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

    		async getNames() {
    			let imageList = [];
    			let arr = this.selectedFiles;
        		for (var i = 0, len = arr.length; i < len; i++) {
					let name = await this.uploadImage(arr[i], i);
					imageList.push(name);
				}
				return imageList;
    		}
    	},

        mounted() {
            console.log('UploadMany component mounted.');
        },

        created() {
        	EventBus.$on('imageSaveMany', (resolve, reject) => {
        		if (this.selectedFiles == null) {
        			resolve();
        			return;
        		}
        		resolve(this.getNames());
        	});
        },

        destroyed() {
			EventBus.$off('imageSaveMany');
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