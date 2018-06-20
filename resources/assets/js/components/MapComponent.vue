<template>
	<div class="ui segment">
		<div class="google-maps">
		    <iframe
		    	src="https://www.google.com/maps/embed?pb=!1m14!1m12!1m3!1d7098.94326104394!2d78.0430654485247!3d27.172909818538997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!5e0!3m2!1sen!2s!4v1385710909804"
		    	width="600"
		    	height="250"
		    	frameborder="0"
		    	style="border:0">
			</iframe>
		</div>
	</div>
	
</template>

<script>
	export default {

    	data: function () {
    		return {

    		}
    	},

    	mounted() {
			$(function () {
			    var mapDiv = document.getElementById("map_canvas");
			    /// Set control options for map
			    var zoptions = {
			        position: google.maps.ControlPosition.TOP_RIGHT,
			        style: google.maps.ZoomControlStyle.SMALL
			    };
			    /// Position of map using coord that were passed else do nothing.
			    var pos = new google.maps.LatLng(40.716948, -74.003563);
			    /// Set basic map options using above control options
			    var options = {
			        zoom: 10,
			        zoomControlOptions: zoptions,
			        mapTypeId: google.maps.MapTypeId.TERRAIN,
			        center: pos
			    };
			    this.map = new google.maps.Map(mapDiv, options);
			});
		}
    };
</script>

<style>
	.google-maps {
        position: relative;
        padding-bottom: 45%; // This is the aspect ratio
        height: 0;
        overflow: hidden;
    }
    .google-maps iframe {
        position: absolute;
        top: 0;
        left: 0;
        width: 100% !important;
        height: 100% !important;
    }
</style>