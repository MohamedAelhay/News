<?php

namespace App\Console\Commands;

use App\Services\EventService;
use Illuminate\Console\Command;

class EventPublish extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'event:publish';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update all event to be publish if started';

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
     * @param EventService $service
     * @return mixed
     */
    public function handle(EventService $service)
    {
        $service->publishEvents();
    }
}
