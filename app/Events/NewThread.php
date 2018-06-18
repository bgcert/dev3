<?php

namespace App\Events;

use App\Messanger\Thread;
use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class NewThread implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $thread;
    public $participant;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct(Thread $thread, $participant)
    {
        $this->thread = $thread;
        $this->participant = $participant;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('threads.' . $this->participant);
    }

    public function broadcastWith()
    {
    	return ['thread' => $this->thread, 'participant' => $this->participant];
    }
}
