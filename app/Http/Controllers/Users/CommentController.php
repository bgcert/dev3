<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommentController extends Controller
{
    public function commentTheme()
    {
    	$theme = \App\Theme::find(request()->id);
    	$comment = $theme->comment(request()->body);
		return $comment;
    }

    public function destroy()
    {
    	return \App\Comment::destroy(request()->id);
    }
}
