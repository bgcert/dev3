<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class UserRegistered extends Mailable
{
    use Queueable, SerializesModels;

	public $token;

    /**
     * Create a new message instance.
     *
     * @return void
     */ 
	public function __construct(\App\VerificationToken $token)
	{
	    $this->token = $token;
	}

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return $this->subject('Please verify your email')
                ->view('auth.email.verification');
    }
}
