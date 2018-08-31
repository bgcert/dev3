<template>
	<div>
		<h2>Multi image upload</h2>
		<template v-if="!multi">
			<div class="single-image" :style="'background-image: url(' + baseUrl + image + ');'">
				
			</div>
		</template>
		<template v-else>
			<div v-for="(image, index) in existingImages">
				<div class="multi-image" :style="'background-image: url(' + baseUrl + image + ');'">
					<button class="ui icon small button delete-button" @click.prevent="remove(index)">
						<i class="red trash icon"></i>
					</button>
				</div>
			</div>
			<div v-for="(image, index) in newImages">
				<div class="multi-image" :style="'background-image: url(' + image.filename + ');'">
					<button class="ui icon small button delete-button" @click.prevent="removeNew(index)">
						<i class="red trash icon"></i>
					</button>
					<div class="progress">
						<el-progress :text-inside="true" :stroke-width="18" :percentage="newImages[index].progress" color="rgba(142, 113, 199, 0.7)"></el-progress>
					</div>
				</div>
			</div>
			<label for="files" class="ui small icon button add-image" ><i class="camera icon"></i> Добави изображение</label>
			<input type="file" name="files" id="files" class="inputfile" @change="onFileChange">
		</template>
		<button class="ui basic button" @click.prevent="uploadAll()">Upload</button>
		<!-- <div v-for="(image, index) in uploadedImages">
			<div
				class="images"
				:style="{
							'background-image': 'url(' + base-url + image + ')',
							'background-position': 'center center'
						}">
			</div>
			<button class="ui small basic button" @click.prevent="detach(index, image.id)">Премахни</button>
		</div>

		<div v-for="(image, index) in images">
			<div
				class="images"
				:style="{
							'background-image': 'url(' + base-url + image + ')',
							'background-position': 'center center'
						}">
			</div>
			<el-progress :percentage="image.progress"></el-progress>
			<button class="ui small basic button" @click.prevent="remove(index)">Премахни</button>
		</div>

		<div>
			<label for="files" class="ui small icon button cover" ><i class="camera icon"></i> Добави</label>
			<input type="file" name="files" id="files" class="inputfile" @change="onFileChange">
		</div> -->
	</div>
</template>

<script>
	import { EventBus } from '../app';
    export default {
    	props: ['multi', 'route', 'base-url', 'image', 'images'],

    	data: function () {
    		return {
    			selectedFiles: [],
    			existingImages: this.images,
    			newImages: [],
    			removed: [],
    			uploadedImages: [],
    			file: [],
    			results: []
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
    			this.newImages.push({ 'filename': imageUrl, 'progress': 0 });

				this.file.push(files[0]);
    		},

    		remove(index) {
    			this.existingImages.splice(index, 1);
    			this.removed.push(index);
    			this.selectedFiles.splice(index, 1);
    			this.file = null;
    		},

    		removeNew(index) {
    			this.newImages.splice(index, 1);
    			this.selectedFiles.splice(index, 1);
    			this.file = null;
    		},

    		detach(index, id) {
    			this.uploadedImages.splice(index, 1);
    			this.$emit('detachClick', id);
    		},

    		async uploadAll() {
    			let filename;
    			for (var i = 0, len = this.file.length; i < len; i++) {
    				filename = await this.uploadImage(this.file[i], i);
    				this.results.push(filename);
    			}

    			console.log('finish uploading');
    		},

    		uploadImage(file, index) {
    			return new Promise((resolve, reject) => {
	    			let vm = this;
	    			let formData = new FormData();
					formData.append('file', file);
	    			axios.post(vm.route, formData, {
	    				onUploadProgress: progressEvent => {
	    					vm.newImages[index].progress = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
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
            console.log('MultiImageUpload component mounted.');
        },

        created() {
        	console.log()
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
	.single-image, .multi-image {
		background-size: cover;
		background-position: center center;
		height: 200px;
		width: 300px;
	}

	.multi-image {
		margin-top: 20px;
		position: relative;
	}

	.multi-image .delete-button {
		position: absolute;
		top: 10px;
		right: 10px;
	}

	.add-image { margin-top: 20px !important; }

	.images {
		padding: 7px;
		background-size: cover;
		position: relative;
		width: 357px;
		height: 178px;
	}

	.progress {
		position: absolute !important;
		height: 40px;
		padding: 10px;
		width: 100%;
		bottom: 0;
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