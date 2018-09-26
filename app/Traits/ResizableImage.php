<?php

namespace App\Traits;

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

    public function moveImage($filename) {
    	if (!$filename) {
    		return;
    	}
    	$path = 'temp/' . $filename;
    	if (\Storage::disk('s3')->exists($path)) {
    		\Storage::disk('s3')->move($path, '/' . $filename);
    	}
    }
}