<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Messanger\Thread;
use Carbon\Carbon;

class MessageController extends Controller
{
    public function index()
    {
    	//$threads = Thread::with('firstParticipant.user', 'lastMessage.user')->whereHas('participants', function ($q) { $q->where('user_id', \Auth::id()); })->get();
    	return view('users.messages');
    }

    public function allThreads()
    {
    	$threads = Thread::with('firstParticipant.user', 'lastMessage.user')
    				->whereHas('participants', function ($q) { $q->where('user_id', request()->auth_id); })
    				->orderBy('updated_at', 'DESC')
    				->get();
    	return $threads;
    }
//
    public function getThread()
    {
    	$thread = Thread::with('messages.user')->where('id', request()->id)->first();
    	return $thread;
    }

    public function store()
    {
    	$message = new \App\Messanger\Message;

    	$message->thread_id = request()->thread;
    	$message->user_id = request()->user_id;
    	$message->body = request()->message;
    	$message->save();

    	// Update thread
    	$thread = Thread::find(request()->thread);
    	$thread->updated_at = Carbon::now();
    	$thread->save();

    	return $message->load('user');
    }
}
