<template>
	<div>
		<div
			class="background"
			:style="{
						'background-image': 'url(' + imageUrl.src + ')',
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
    	props: ['image'],

    	data: function () {
    		return {
    			selectedFile: null,
    			progress: 0,
    			imageUrl: { src: '/img/default_cover.png' },
    			file: null,
    			filename: null,
    			data: null
    		}
    	},
    	watch: {
    		image: function (val) {
    			return this.imageUrl.src = val;
    		}
    	},

    	methods: {
    		onFileChange(e) {
    			this.selectedFile = event.target.files[0];
    			let vm = this;

    			var files = e.target.files || e.dataTransfer.files;
    			var url = URL.createObjectURL(files[0]);
    			this.imageUrl = new Image;
    			
    			this.imageUrl.src = url;

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
        		if (!this.selectedFile) {
        			resolve();
        			return;
        		}
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

	.background {
		padding: 7px;
		background-image: url("/img/default_cover.png");
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