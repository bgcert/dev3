<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class TruncateVisits extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'truncate:visits';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Truncate visits table for use of counting daily visitors.';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        \DB::table('visits')->truncate();
    }
}
