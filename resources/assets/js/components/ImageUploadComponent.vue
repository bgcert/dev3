<template>
	<div @mousemove="handleImageMove">
		<div id="image" @mousedown.prevent="handleMouseDown" @mouseenter="handleMouseEnter">
			<input type="file" name="file" id="file" class="inputfile" @change="onFileChange">
			<label for="file" class="ui small purple icon button cover" ><i class="camera icon"></i> Качи</label>
		</div>
		<button class="ui small positive icon button" @click.prevent="save"><i class="save icon"></i> Запиши</button>		
	</div>
</template>

<script>
    export default {
    	props: ['img', 'canvasWidth', 'canvasHeight', 'position'],

    	data: function () {
    		return {
    			image: null,
    			mouseDown: false,
    			start_y: null,
    			newPos: null,
    			deviation: null,
    			curPos: this.position,
    		}
    	},

    	methods: {
    		save() {
    			console.log('save: ' + this.curPos);
    		},

    		onFileChange(e) {
    			this.mouseDown = false;
    			const file = e.target.files[0];
    			$('#image').css('background-image', 'url(' + URL.createObjectURL(file) + ')');
    			this.image = new Image();
				this.image.src = URL.createObjectURL(file);
				this.curPos = 0;
				$(this.image).on('load', this.reposition);
    		},

    		handleMouseEnter(e) { this.start_y = e.clientY; },
    		handleMouseDown() { this.mouseDown = true; },
    		handleMouseUp() { this.mouseDown = false; console.log('up'); },

    		handleImageMove(e) {
				this.newPos = e.clientY - this.start_y;
				this.start_y = e.clientY;
				if (this.mouseDown) {
					$('#image').css('background-position-y', '+=' + this.newPos);
					this.curPos = parseInt($('#image').css('background-position-y'));
					if (this.curPos > 0) this.curPos = 0;
					if (this.curPos < -this.deviation) this.curPos = -this.deviation;
					$('#image').css('background-position-y', this.curPos);
				}
			},

    		reposition() {
    			$(document).mouseup(this.handleMouseUp);
        		$(document).mousemove(this.handleImageMove);
				$('#image').css('background-image', "url(" + this.image.src + ")");
				$('#image').css('background-position-y', -this.curPos);
				var w = this.image.width;
				var h = this.image.height;
				var ratio = w / this.canvasWidth;
				var newHeight = Math.floor(h / ratio);
				this.deviation = newHeight - this.canvasHeight;
			}
    	},

        mounted() {
            console.log('Image component mounted.');
            if (this.img) {
            	let vm = this;
				this.image = new Image();
				this.image.src = this.img;
				$(this.image).on('load', vm.reposition);
            } else {
            	$('#image').css('background-image', "url(img/default_cover.png)");
            }
        }
    };
</script>

<style>
	.cover {
		margin: 10px;
	}

	#image {
		padding: 7px;
		width: 357px;
		height: 178px;
		background-size: cover;
		cursor: -webkit-grab;
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