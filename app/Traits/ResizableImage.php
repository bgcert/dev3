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

    	// Return resized image
		return $image;
    }

    // public function save($image, $filename, $path = null)
    // {
    // 	if ($path) {
    // 		return $image->save(public_path(config('app.photo_storage') . $path) . $filename);
    // 	}

    // 	return $image->save(public_path(config('app.photo_storage')) . $filename);
    // }

    public function unique_hash()
    {
    	return md5(microtime());
    }    
}