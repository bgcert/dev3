<template>
	<div>
		<div
			class="image"
			:style="{
						'background-image': 'url(' + image.src + ')',
						'background-position': 'center center'
					}">
			<input type="file" name="file" id="file" class="inputfile" @change="onFileChange">
			<label for="file" class="ui small purple icon button cover" ><i class="camera icon"></i> Качи</label>
		</div>
		<el-progress :percentage="progress"></el-progress>
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
    			selectedFile: null,
    			progress: 0,
    			image:
	    			{
	    				src: this.img ? this.img : 'img/default_cover.png'
	    			},
    			file: null,
    			filename: null,
    			data: null
    		}
    	},

    	methods: {
    		onFileChange(e) {
    			this.selectedFile = event.target.files[0];
    			let vm = this;

    			var files = e.target.files || e.dataTransfer.files;
    			var imageUrl = URL.createObjectURL(files[0]);
    			this.image = new Image;
    			
    			this.image.src = imageUrl;

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
        	EventBus.$on('imageSave', (resolve, reject) => {
        		const formData = new FormData()
  				formData.append('file', this.selectedFile);
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

	.image {
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