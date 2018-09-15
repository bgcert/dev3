<template>
	<div>
		<template v-if="errors" v-for="error in errors">
			 <el-alert type="error" :title="error"></el-alert>
		</template>
		<div class="single-image" :style="'background-image: url(' + image.filename + ');'">
			<label :for="'image'" class="ui small purple icon button" ><i class="camera icon"></i> Качи изображение</label>
			<input type="file" :id="'image'" class="inputfile" @change="onFileChange">
			<div class="progress" v-if="image.progress >= 0">
				<el-progress :text-inside="true" :stroke-width="18" :percentage="image.progress" color="rgba(142, 113, 199, 0.7)"></el-progress>
			</div>
		</div>
	</div>
</template>

<script>
	import { EventBus } from '../app';
    export default {
    	props: ['imageUrl'],

    	data: function () {
    		return {
    			image: { filename: this.imageUrl, progress: -1, file: null },
    			result: null,
    			errors: null,
    			uploaded: false,
    			uploadedFileName: null
    		}
    	},

    	methods: {
    		onFileChange(e) {
    			let vm = this;

    			var files = e.target.files || e.dataTransfer.files;
    			var imageUrl = URL.createObjectURL(files[0]);
    			this.image = { filename: imageUrl, progress: 0, file: files[0] };
    			this.uploadedFileName = null;
    			this.errors = null;
    		},

    		upload() {
    			return new Promise((resolve, reject) => {
	    			let vm = this;

	    			// If this attatched file is already uploaded no need to upload it again
	    			if (this.uploadedFileName != null) {
	    				resolve(this.uploadedFileName);
	    				return;
	    			}

	    			let formData = new FormData();
					formData.append('file', vm.image.file);
	    			axios.post('/dashboard/image/upload', formData, {
	    				onUploadProgress: progressEvent => {
	    					vm.image.progress = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
	    				}
	    			})
	    			.then(function (responce) {
	    				vm.uploadedFileName = responce.data;
	    				resolve(vm.uploadedFileName);
	    			})
	    			.catch(function (error) {
	    				vm.errors = error.response.data.errors.file;
	    				reject(error.response.data.errors.file);
	    			})
    			});
    		},
    	},

        mounted() {
            console.log('ImageUpload component mounted.');
        },

        created() {
        	EventBus.$on('upload', (resolve, reject) => {
        		if (this.image.file == null) {
        			// Image is not required. Empty resolve.
        			resolve();
        			return;
        		}
        		let results = this.upload();
        		resolve(results);
        	});
        },

        destroyed() {
			EventBus.$off('upload');
		}
    };
</script>

<style>
	.single-image {
		position: relative;
		background-size: cover;
		background-repeat: no-repeat;
		background-position: center center;
		width: 250px;
		height: 150px;
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