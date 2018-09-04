<template>
	<div>
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
    	props: ['route', 'imageUrl'],

    	data: function () {
    		return {
    			image: { filename: this.imageUrl, progress: -1, file: null },
    			result: null,
    		}
    	},

    	methods: {
    		onFileChange(e) {
    			let vm = this;

    			var files = e.target.files || e.dataTransfer.files;
    			var imageUrl = URL.createObjectURL(files[0]);
    			this.image = { filename: imageUrl, progress: 0, file: files[0] };
    		},

    		upload() {
    			return new Promise((resolve, reject) => {
	    			let vm = this;
	    			let formData = new FormData();
					formData.append('file', vm.image.file);
	    			axios.post(vm.route, formData, {
	    				onUploadProgress: progressEvent => {
	    					vm.image.progress = Math.round( (progressEvent.loaded * 100) / progressEvent.total );
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
    	},

        mounted() {
            console.log('ImageUpload component mounted.');
        },

        created() {
        	EventBus.$on('upload', (resolve, reject) => {
        		if (this.image.file == null) {
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
		background-position: center center;
		height: 200px;
		width: 300px;
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