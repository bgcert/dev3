<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Messanger\Thread;
use App\Events\NewMessage;
use App\Events\NewThread;
use Carbon\Carbon;

class MessageController extends Controller
{
    public function index()
    {
    	return view('messanger');
    }

    public function getUserBy()
    {
    	return \App\User::with('company')->where('id', request()->id)->first();
    }

    public function getThreads()
    {
    	$threads = Thread::with('firstContact.user.company.company_detail', 'lastMessage.user')
    				->whereHas('contacts', function ($q)
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
    	$thread = Thread::with('firstContact.user', 'messages.user')->where('id', $id)->first();
    	return $thread;
    }

    public function newThread()
    {
    	// Check if thread already exist - Validation!
    	$thread = Thread::whereHas('contacts', function ($q)
    				{
    					$q->where('user_id', \Auth::id());
    				})
    				->whereHas('contacts', function ($q)
    					{
    						$q->where('user_id', request()->to);
    					})
    				->first();

    	if ($thread === null) {
    		$thread = new \App\Messanger\Thread;
    		$thread->save();

    		$thread->contacts()->createMany([
	    		['user_id' => \Auth::id()],
	    		['user_id' => request()->to]
	    	]);
    	}

    	broadcast(new NewThread($thread, request()->to));

    	$thread->load('firstContact.user', 'lastMessage');

    	return $thread;
    }

	public function addMessage()
    {
    	$message = new \App\Messanger\Message;

    	$message->thread_id = request()->thread_id;
    	$message->user_id = \Auth::id();
    	$message->body = request()->input;
    	$message->save();

    	// Update thread
    	$thread = Thread::find(request()->thread_id);
    	$thread->updated_at = Carbon::now();
    	$thread->save();

    	broadcast(new NewMessage($message));

    	return $message->load('user');
    }

    public function seen()
    {
    	$contact = \App\Messanger\Contact::where('user_id', \Auth::id())->where('thread_id', request()->thread_id)->first();

    	$contact->last_read = Carbon::now();
    	$contact->save();
    	return $contact->thread->id;
    }

    public function search()
    {
    	$users = \App\User::where('firstname', 'LIKE', '%' . request()->searchQuery . '%')
    						->orWhere('lastname', 'LIKE', '%' . request()->searchQuery . '%')
    						->limit(5)
    						->get();
    	return $users;
    }
}
