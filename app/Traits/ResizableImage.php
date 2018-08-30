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

    public function save($image, $filename, $path)
    {
		return $image->save(public_path('/photos' . $path) . $filename);
    }

    public function unique_hash()
    {
    	return md5(microtime());
    }

    public function saveThemeCover($file, $theme_id)
    {
    	$prefix = 'th' . $theme_id . '_c' . \Auth::user()->company->id . '_';
    	$filename = $prefix . $this->unique_hash() . '.' . $file->getClientOriginalExtension();

    	// Make image from file
    	$image = Image::make($file);

    	// Save original file
    	$this->save($image, $filename, '/or/');

    	// Resize to m size
    	$this->resize($image, 300, 160);
    	$this->save($image, $filename, '/th/m/');

    	// New image instance. Old one is already resized. Wtf?
    	$image = Image::make($file);
    	// Resize to l size
    	$this->resize($image, 1200, 400);
    	$this->save($image, $filename, '/th/l/');

    	return $filename;
    }

    public function saveEventCover($file, $event_id)
    {
    	$prefix = 'ev' . $event_id . '_c' . \Auth::user()->company->id . '_';
    	$filename = $prefix . $this->unique_hash() . '.' . $file->getClientOriginalExtension();

    	// Make image from file
    	$image = Image::make($file);

    	// Save original file
    	$this->save($image, $filename, '/or/');

    	// Resize to m size
    	$this->resize($image, 300, 160);
    	$this->save($image, $filename, '/ev/m/');

    	// New image instance. Old one is already resized. Wtf?
    	$image = Image::make($file);
    	// Resize to l size
    	$this->resize($image, 1200, 400);
    	$this->save($image, $filename, '/ev/l/');

    	return $filename;
    }

    public function saveTeacherPhoto($file, $teacher_id)
    {
    	$prefix = 'te' . $teacher_id . '_c' . \Auth::user()->company->id . '_';
    	$filename = $prefix . $this->unique_hash() . '.' . $file->getClientOriginalExtension();

    	// Make image from file
    	$image = Image::make($file);

    	// Save original file
    	$this->save($image, $filename, '/or/');

    	// Resize to m size
    	$this->resize($image, 300, 300);
    	$this->save($image, $filename, '/te/');

    	return $filename;
    }

    public function saveVenueCover($file, $venue_id)
    {
    	$prefix = 've' . $venue_id . '_c' . \Auth::user()->company->id . '_';
    	$filename = $prefix . $this->unique_hash() . '.' . $file->getClientOriginalExtension();

    	// Make image from file
    	$image = Image::make($file);

    	// Save original file
    	$this->save($image, $filename, '/or/');

    	// Resize to m size
    	$this->resize($image, 300, 160);
    	$this->save($image, $filename, '/ve/m/');

    	// New image instance. Old one is already resized. Wtf?
    	$image = Image::make($file);
    	// Resize to l size
    	$this->resize($image, 1200, 400);
    	$this->save($image, $filename, '/ve/l/');

    	return $filename;
    }

    public function saveVenueImage($file)
    {
    	$prefix = 'vi_c' . \Auth::user()->company->id . '_';
    	$filename = $prefix . $this->unique_hash() . '.' . $file->getClientOriginalExtension();

    	// Make image from file
    	$image = Image::make($file);

    	// Save original file
    	$this->save($image, $filename, '/or/');

    	// Resize to m size
    	$this->resize($image, 1200, 400);
    	$this->save($image, $filename, '/vi/');

    	// // New image instance. Old one is already resized. Wtf?
    	// $image = Image::make($file);
    	// // Resize to l size
    	// $this->resize($image, 1200, 400);
    	// $this->save($image, $filename, '/ve/l/');

    	return $filename;
    }
    
}