<?php

namespace App\Traits;

use Image;

trait ResizableImage
{
	public function resize($image, $w, $h)
    {
		$relation = $w / $h;

    	$resizeWidth = $w * $relation;
    	$resizeHeight = $h * $relation;

    	if ($image->width() / $image->height() < $relation) {
    		$image->resize($w, null, function ($constraint) {
			    $constraint->aspectRatio();
			    $constraint->upsize();
			});
    	} else {
    		$image->resize(null, $h, function ($constraint) {
			    $constraint->aspectRatio();
			    $constraint->upsize();
			});
    	}

		return $image;
    }   
}