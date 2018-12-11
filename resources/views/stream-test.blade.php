<!-- ideally this should be in <head> -->  

<!-- videojs must be included first -->
<link href="//vjs.zencdn.net/4.12/video-js.css" rel="stylesheet">
<script src="//vjs.zencdn.net/4.12/video.js"></script>

<script src="//cdn.viblast.com/vb/stable/viblast.js"></script>

<!-- body -->
<!-- techs will be included automatically. By default the order is: "viblast,viblastflash, html5" -->
<video id="example_video_1" class="video-js vjs-default-skin"
       controls="true" preload="auto" width="800" height="600" autoplay
       poster="http://video-js.zencoder.com/oceans-clip.png"
       data-setup='{}'
       data-viblast-key="N8FjNTQ3NDdhZqZhNGI5NWU5ZTI=">
  <!-- this is an important to specify the type of the video. Use 'application/x-mpegURL' for HLS streams or 'application/dash+xml' for DASH streams -->
  <source src="//streaming.seminari365.com/live/test4_hd.m3u8?auth_key=1544580848-0-0-7161ed641153d907279bfa2d85d39bea" type='application/x-mpegURL' />
  <p class="vjs-no-js">To view this video please enable JavaScript, and consider upgrading to a web browser that <a href="http://videojs.com/html5-video-support/" target="_blank">supports HTML5 video</a></p>
</video>

