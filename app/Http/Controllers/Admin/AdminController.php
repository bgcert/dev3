<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;

class AdminController extends Controller
{
	public function index()
    {
    	return view('admin.index');
    }

    public function activity()
    {
        $activity = Activity::all();
    	return view('admin.index', compact('activity'));
    }

    public function slugBuilder()
    {
        $themes = \App\Theme::where('slug'. null)->get();

        foreach ($themes as $theme) {
            echo '<li>' . $theme->title . '</li>: ' . $this->slugify($theme->title);
        }


        return 'slug builder';
    }

    public static function slugify($text)
    {
        // replace non letter or digits by -
        $text = preg_replace('~[^\pL\d]+~u', '-', $text);

        // transliterate
        $text = mb_convert_encoding($text, "UTF-8");

        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);

        // trim
        $text = trim($text, '-');

        // remove duplicate -
        $text = preg_replace('~-+~', '-', $text);

        // lowercase
        $text = strtolower($text);
        
        return $text;
    }
}
