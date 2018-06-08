<template>
	<div @mousemove="handleImageMove">
		<div
			id="image"
			@mousedown.prevent="handleMouseDown"
			@mouseenter="handleMouseEnter"
			:style="{
						'background-image': 'url(' + image.src + ')',
						'width': canvasWidth + 'px',
						'height': canvasHeight + 'px',
						'background-position': 'center center'
					}">
			<input type="file" name="file" id="file" class="inputfile" @change="onFileChange">
			<label for="file" class="ui small purple icon button cover" ><i class="camera icon"></i> Качи</label>
			<div v-if="movable" class="ui top right attached icon label"><i class="arrows alternate icon"></i></div>
		</div>
	</div>
</template>

<script>
	import { EventBus } from '../app';
    export default {
    	props: {
    		img: String,
    		canvasWidth: Number,
    		canvasHeight: Number,
    		position: Number,
    		movable: {
		      default: false,
		      type: Boolean
		    }
    	},

    	data: function () {
    		return {
    			image:
	    			{
	    				src: 'img/default_cover.png'
	    			},
    			mouseDown: false,
    			start_y: null,
    			newPos: null,
    			deviation: null,
    			curPos: this.position,
    			file: null,
    			filename: null,
    			data: null
    		}
    	},

    	methods: {
    		onFileChange(e) {
    			let vm = this;

    			var files = e.target.files || e.dataTransfer.files;
    			var imageUrl = URL.createObjectURL(files[0]);
    			this.image = new Image;
    			
				this.image.onload = function() {
    				vm.reposition(this.width, this.height);
    			};	
    			
    			this.image.src = imageUrl;

    			this.mouseDown = false;
				this.curPos = 0;

				this.file = files[0];
    		},

    		handleMouseEnter(e) { this.start_y = e.clientY; },
    		handleMouseDown() { this.mouseDown = true; },
    		handleMouseUp() { this.mouseDown = false; },

    		handleImageMove(e) {
				this.newPos = e.clientY - this.start_y;
				this.start_y = e.clientY;
				if (this.movable) {
					$('#image').css('cursor', '-webkit-grab');
				}
				if (this.mouseDown && this.movable) {
					$('#image').css('background-position-y', '+=' + this.newPos);
					this.curPos = parseInt($('#image').css('background-position-y'));
					if (this.curPos > 0) this.curPos = 0;
					if (this.curPos < -this.deviation) this.curPos = -this.deviation;
					$('#image').css('background-position-y', this.curPos);
				}
			},

    		reposition(w, h) {
    			$(document).mouseup(this.handleMouseUp);
        		$(document).mousemove(this.handleImageMove);
				$('#image').css('background-position-y', -this.curPos);
				var ratio = w / this.canvasWidth;
				var newHeight = Math.floor(h / ratio);
				this.deviation = newHeight - this.canvasHeight;
			}
    	},

        mounted() {
            console.log('Image component mounted.');
        },

        created() {
        	EventBus.$on('imageSave', (resolve, reject) => {
				console.log(this.curPos);
				let data = [this.file, this.canvasWidth, this.curPos];
				resolve(data);
        	});
        }
    };
</script>

<style>
	.cover { margin: 10px; }

	#image {
		padding: 7px;
		background-size: cover;
		position: relative;
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