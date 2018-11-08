<template>
	<div>
		<div
			class="multi-image existing"
			:style="'background-image: url(https://d3cwccg7mi8onu.cloudfront.net/fit-in/250x150/' + item.filename + ');'"
			v-for="(item, index) in existing"
			:key="index">
			<button class="btn blue small" @click.prevent="detach(index, item.id)"> Премахни</button>
		</div>

		<div>
			<div v-for="(image, index) in images" :key="index">
				<div v-if="image.error" style="margin-top: 10px;">
					<el-alert type="error" :title="image.error"></el-alert>
				</div>
				<div class="multi-image" :style="'background-image: url(' + image.filename + ');'">
					<div class="progress" v-if="image.progress >= 0">
						<el-progress :text-inside="true" :stroke-width="18" :percentage="image.progress" color="rgba(142, 113, 199, 0.7)"></el-progress>
					</div>
					<button class="btn blue small" @click.prevent="remove(index)"> Премахни</button>
				</div>
			</div>
		</div>

		<div
			class="multi-image existing"
			:style="'background-image: url(/img/default_cover.png);'">
			<label :for="'multi-image'" class="btn blue"> Добави изображение</label>
			<input type="file" :id="'multi-image'" class="inputfile" @change="onFileChange">
		</div>
	</div>
</template>

<script>
	import { EventBus } from '../app';
    export default {
    	props: ['existingImages'],

    	data: function () {
    		return {
    			selectedFiles: [],
    			newImages: [],
    			uploadedImages: [],
    			result: [],
    			images: [],
    			existing: this.existingImages,
    			filenames: [],
    			imageErrors: []
    		}
    	},

    	methods: {
    		add() {
    			this.images.push({ filename: this.imageUrl, progress: -1 });
    		},

    		onFileChange(e) {
    			let vm = this;
    			let index = this.images.length - 1;
    			var files = e.target.files || e.dataTransfer.files;
    			var imageUrl = URL.createObjectURL(files[0]);
    			this.images.push({ filename: imageUrl, progress: 0, file: files[0], error: null });
    		},

    		remove(index) {
    			this.images.splice(index, 1);
    			this.filenames.splice(index, 1);
    		},

    		removeNew(index) {
    			this.newImages.splice(index, 1);
    			this.selectedFiles.splice(index, 1);
    			this.file = null;
    		},

    		detach(index, id) {
    			this.existing.splice(index, 1);
    			this.$emit('detachClick', id);
    		},

    		async getFilenames() {
    			this.imageErrors = [];
    			for (let i = 0; i < this.images.length; i++) {
    				if (this.filenames[i]) {
    					continue;
    				}

    				try {
						let filename = await this.upload(i);
						this.filenames.push(filename);
					} catch(e) {
						this.imageErrors.push(e);
						this.images[i].error = e;
					}
    			}
    			if (this.imageErrors.length) {
    				return null;
    			}
    			return this.filenames;
    		},

    		upload(i) {
    			return new Promise((resolve, reject) => {
	    			let vm = this;

	    			let result;
	    			let config = {
					    				headers: {
					    					'Content-Type': 'multipart/form-data'
					    				}
					    			}
					let formData = new FormData();
					formData.append('file', vm.images[i].file);
	    			axios.post('dashboard/image/upload', formData, {
	    				onUploadProgress: progressEvent => {
	    					vm.images[i].progress = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
	    				}
	    			})
	    			.then(function (responce) {
	    				resolve(responce.data);
	    			})
	    			.catch(function (error) {
	    				reject(error.response.data.errors.file[0]);
	    			})
    			});
    		},
    	},

        mounted() {
            console.log('ImageUpload component mounted.');
        },

        created() {
        	EventBus.$on('multi-upload', (resolve, reject) => {
        		if (this.images.length == 0) {
        			resolve();
        			return;
        		}
        		let results = this.getFilenames();
        		resolve(results);
        	});
        },

        destroyed() {
			EventBus.$off('multi-upload');
		}
    };
</script>

<style>
	.multi-image {
		position: relative;
		background-size: cover;
		background-position: center center;
		width: 250px;
		height: 150px;
	}

	.multi-image {
		margin-top: 20px;
	}

	.multi-image .delete-button {
		position: absolute;
		top: 10px;
		right: 10px;
	}

	.add-image { margin-top: 20px !important; }

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