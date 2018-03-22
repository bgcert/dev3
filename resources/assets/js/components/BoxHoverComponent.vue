<template>
    <div>
    	<!-- <div v-show="active">
    		<div class="btn btn-default">
    			<h1>hi</h1>
    		</div>
    	</div> -->
    	<div class="box-hover">
    		<div class="content-box">
    			<h1>{{ name }}</h1>
    		</div>
    		<a href="#" @mouseover="mouseOver">{{ name }} hover</a>
    		
    	</div>
    </div>
</template>

<script>
    export default {
    	props: ['name'],

    	data: function () {
    		return {
    			active: false
    		}
    	},

	    methods: {
	        mouseOver: function(){
	            this.active = !this.active;   
	        }
	    },

        mounted() {
            console.log('Box hover mounted.')
        }
    }
</script>

<style>
	.box-hover {
		position: relative;
	}

	.content-box {
		visibility: hidden;
		border: 1px solid #999;
		background-color: #fff;
		position: absolute;
	    z-index: 1;
	    top: -80px;
	    padding: 10px;
	}

	.box-hover:hover .content-box {
	    visibility: visible;
	}

	.content-box:hover {
		visibility: visible;
	}
</style>