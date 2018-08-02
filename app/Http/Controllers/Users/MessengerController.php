<?php

namespace App\Http\Controllers\Users;

use Auth;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Events\NewMessage;
use App\Events\NewThread;

class MessengerController extends Controller
{
    
    public function threads()
    {
    	return Auth::user()->threads;
    }

    public function thread($id)
    {
    	return Auth::user()->threads->where('id', $id)->first()->append('read');
    }

	public function messages($id)
    {
    	return $this->thread($id)->messages;
    }

	public function addMessage($id)
    {
    	$message = $this->thread($id)->newMessage(request()->body);
    	broadcast(new NewMessage($message));
    	return $message;
    }

	public function newThreadWith($user_id)
	{
		$thread = new \App\Thread;
    	$thread->save();

    	// add the participants
    	$thread->participants()->createMany([
    		['user_id' => $user_id], // $user_id is the new participant id
    		['user_id' => Auth::user()->id]
    	]);

    	broadcast(new NewThread($thread, $user_id));

    	return $thread;
	}    

    public function newMessage()
    {
    	// Needs special validation!!! If thread with that user already exist for example!
    	// For example: find thread with first_participant where first_participant is request()->user_id

    	// create a thread with new participant
    	$thread = $this->newThreadWith(request()->user_id);

    	// post a message to created thread
    	$this->thread($thread->id)->newMessage(request()->body);
    	return $thread->load('first_participant.user', 'lastMessage');
    }

	public function search()
    {
    	$existing = $this->threads()->pluck('first_participant.user_id')->toArray();

    	return \App\User::where('firstname', 'like', '%'.request()->text.'%')
    						->where('id', '!=', Auth::user()->id)
    						->whereNotIn('id', $existing)
    						->limit(10)
    						->get();
    }

    public function seen() {
    	$thread = \App\Thread::find(request()->thread_id);
    	$participant = $thread->participants()->where('user_id', Auth::user()->id)->first();
    	$participant->update(['read_message_id' => request()->read_message_id, 'read_at' => \Carbon\Carbon::now()]);
    	return 'seen';
    }
}
