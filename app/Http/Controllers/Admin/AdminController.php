<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Activitylog\Models\Activity;
use Illuminate\Support\Str;

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
        // $themes = \App\Theme::where('slug', '')->withTrashed()->get();
        $themes = \App\Theme::withTrashed()->get();

        foreach ($themes as $theme) {
            $slug = self::transliterate($theme->title);
            $theme->timestamps = false;
            $theme->slug = Str::slug($slug, '-');
            $theme->save();
            echo '<li>' . $theme->title . '</li>: ' . $theme->slug;
        }
    }

    public static function transliterate($str)
    {
        $cyr = [
                'ж',  'ч',  'щ',   'ш',  'ю',  'а', 'б', 'в', 'г', 'д', 'е', 'з', 'и', 'й', 'к', 'л', 'м', 'н', 'о', 'п', 'р', 'с', 'т', 'у', 'ф', 'х', 'ц', 'ъ', 'ь', 'я',
                'Ж',  'Ч',  'Щ',   'Ш',  'Ю',  'А', 'Б', 'В', 'Г', 'Д', 'Е', 'З', 'И', 'Й', 'К', 'Л', 'М', 'Н', 'О', 'П', 'Р', 'С', 'Т', 'У', 'Ф', 'Х', 'Ц', 'Ъ', 'Ь', 'Я'];
        $lat = [
                'zh', 'ch', 'sht', 'sh', 'yu', 'a', 'b', 'v', 'g', 'd', 'e', 'z', 'i', 'j', 'k', 'l', 'm', 'n', 'o', 'p', 'r', 's', 't', 'u', 'f', 'h', 'c', 'y', 'x', 'q',
                'Zh', 'Ch', 'Sht', 'Sh', 'Yu', 'A', 'B', 'V', 'G', 'D', 'E', 'Z', 'I', 'J', 'K', 'L', 'M', 'N', 'O', 'P', 'R', 'S', 'T', 'U', 'F', 'H', 'c', 'Y', 'X', 'Q'];

        return str_replace($cyr, $lat, $str);
    }
}
