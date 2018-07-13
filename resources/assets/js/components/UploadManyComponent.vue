<template>
	<div>
		<div v-for="(instance, index) in instances">
			<div
				class="images"
				:style="{
							'background-image': 'url(' + imageList[index].src + ')',
							'background-position': 'center center'
						}">
			</div>
			<el-progress :percentage="progress"></el-progress>
		</div>
		<div>
			<label for="files" class="ui small purple icon button cover" ><i class="camera icon"></i> Качи</label>
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
    			dialogImageUrl: '',
        		dialogVisible: false,
    			instances: 0,
    			selectedFiles: [],
    			progress: 0,
    			imageList: [],
    			file: null,
    			filename: null,
    			data: null
    		}
    	},

    	methods: {
    		onFileChange(e) {
    			this.instances++;
    			this.selectedFiles.push(event.target.files[0]);
    			let vm = this;

    			var files = e.target.files || e.dataTransfer.files;
    			var imageUrl = URL.createObjectURL(files[0]);
    			console.log(imageUrl);
    			let image = new Image;
    			image.src = imageUrl;
    			this.imageList.push(image);

				this.file = files[0];
    		},
    		upload() {
    			const formData = new FormData()
  				formData.append('file', this.selectedFile);
    			axios.post('dashboard/image/upload', formData, {
    				onUploadProgress: progressEvent => {
    					this.progress =  Math.round( (progressEvent.loaded * 100) / progressEvent.total );
    				}
    			})
    		}
    	},

        mounted() {
            console.log('Image component mounted.');
        },

        created() {
        	EventBus.$on('imageSaveMany', (resolve, reject) => {
        		const formData = new FormData()
        		this.selectedFiles.forEach(function (file) {
        			formData.append('file', file);
        		});
    			axios.post('dashboard/image/upload', formData, {
    				onUploadProgress: progressEvent => {
    					this.progress =  Math.round( (progressEvent.loaded * 100) / progressEvent.total );
    				}
    			})
    			.then(function (responce) {
    				resolve(responce.data);
    			})
    			.catch(function () {
    				reject('error');
    			})
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