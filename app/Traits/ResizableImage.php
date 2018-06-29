<?php

namespace App\Traits;

use Image;

trait ResizableImage
{
	public function saveImage($file, $w, $h)
    {
    	$extension = $file->getClientOriginalExtension();
    	$img = Image::make($file);

    	$relation = $w / $h;

    	$resizeWidth = $w * $relation;
    	$resizeHeight = $h * $relation;

    	if ($img->width() / $img->height() < $relation) {
    		$img->resize($w, null, function ($constraint) {
			    $constraint->aspectRatio();
			});
    	} else {
    		$img->resize(null, $h, function ($constraint) {
			    $constraint->aspectRatio();
			});
    	}
		
		// Generate random name
		$newName = md5(microtime()) . '.' . $extension;

		// finally we save the image as a new file
		$img->save(public_path('test/') . $newName);

    	return $newName;
    }
}