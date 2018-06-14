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
    public function getThreadByUser($id)
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

    public function newMessage()
    {
    	$thread = new \App\Messanger\Thread;
    	$thread->save();

    	$thread->participants()->createMany([
    		['user_id' => \Auth::id()],
    		['user_id' => request()->to]
    	]);

    	$message = new \App\Messanger\Message;

    	$message->thread_id = $thread->id;
    	$message->user_id = \Auth::id();
    	$message->body = request()->input;
    	$message->save();

    	broadcast(new NewMessage($message));

    	// Update thread
    	$thread->updated_at = Carbon::now();
    	//$thread->save();
    	$data = [$thread->load('firstParticipant.user', 'messages.user'), $message->load('user') ];
    	return $data;
    }

    public function search()
    {
    	$users = \App\User::where('name', 'LIKE', '%' . request()->searchQuery . '%')->limit(5)->get();
    	return $users;
    }
}
