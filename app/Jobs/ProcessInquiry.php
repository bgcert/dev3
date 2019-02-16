<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;

use App\Company;
use App\Events\NewNotification;
use App\Notifications\NewInquiry;

class ProcessInquiry implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $company;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Company $company)
    {
        $this->company = $company;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        // Event owner
    	// $owner = $this->event->theme->company->user;

    	// Send email notification
    	$this->company->user->notify(new NewInquiry());

    	// Add push notification
    	broadcast(new NewNotification($this->company->id));
    }
}
