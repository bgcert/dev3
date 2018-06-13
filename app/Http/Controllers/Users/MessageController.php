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
    	return view('messanger');
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
    	$data = [$threads, \Auth::id()];
    	return $data;
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

    	$message->thread_id = request()->thread_id;
    	$message->user_id = \Auth::id();
    	$message->body = request()->input;
    	$message->save();

    	broadcast(new NewMessage($message));

    	// Update thread
    	$thread = Thread::find(request()->thread_id);
    	$thread->updated_at = Carbon::now();
    	$thread->save();

    	return $message->load('user');
    }
}
