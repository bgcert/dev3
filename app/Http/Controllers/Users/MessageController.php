<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Messanger\Thread;

class MessageController extends Controller
{
    public function index()
    {

    	// $thread = Thread::find(1);
    	// dd($thread->latestMessage);
    	$threads = Thread::with('firstParticipant.user', 'lastMessage.user')->whereHas('participants', function ($q) { $q->where('user_id', \Auth::id()); })->get();
    	//dd($threads[2]->firstParticipant);
    	return view('users.messages', compact('threads'));
    }
}
