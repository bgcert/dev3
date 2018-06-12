<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Messanger\Thread;
use App\Events\NewMessage;
use Carbon\Carbon;

class MessageController extends Controller
{
    public function index()
    {
    	//$threads = Thread::with('firstParticipant.user', 'lastMessage.user')->whereHas('participants', function ($q) { $q->where('user_id', \Auth::id()); })->get();
    	return view('users.messages');
    }

    public function getThreads()
    {
    	$threads = Thread::with('firstParticipant.user', 'lastMessage.user')
    				->whereHas('participants', function ($q)
    				{
    					$q->where('user_id', \Auth::id());
    				})
    				->orderBy('updated_at', 'DESC')
    				->get();
    	return $threads;
    }
//
    public function getThreadBy($id)
    {
    	$thread = Thread::with('firstParticipant.user', 'messages.user')->where('id', $id)->first();
    	return $thread;
    }

	public function addMessage()
    {
    	$message = new \App\Messanger\Message;

    	$message->thread_id = request()->thread;
    	$message->user_id = \Auth::id();
    	$message->body = request()->input;
    	$message->save();

    	// Update thread
    	$thread = Thread::find(request()->thread);
    	$thread->updated_at = Carbon::now();
    	$thread->save();

    	broadcast(new NewMessage($message));

    	return $message->load('user');
    }
}
