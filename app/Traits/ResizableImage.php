<?php

namespace App\Traits;

use Image;

trait ResizableImage
{
	public function saveImage($file)
    {
    	$w = 357;
    	$h = 178;
    	//$file = request()->file;
    	$extension = $file->getClientOriginalExtension();
    	$img = Image::make($file);

    	if ($img->width() <= $img->height()) {
    		$img->resize($w, null, function ($constraint) {
			    $constraint->aspectRatio();
			});
    	} else {
    		$img->resize(null, $h, function ($constraint) {
			    $constraint->aspectRatio();
			});
    	}

		// now you are able to resize the instance
		// $img->resize(request()->width, null, function ($constraint) {
		//     $constraint->aspectRatio();
		// });
		
		// Generate random name
		$newName = md5(microtime()) . '.' . $extension;

		// finally we save the image as a new file
		$img->save(public_path('test/') . $newName);

    	return $newName;
    }
}