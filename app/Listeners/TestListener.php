<?php

namespace App\Listeners;

use App\Events\TestEvent;
use Illuminate\Support\Facades\Log;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class TestListener implements ShouldQueue
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TestEvent $event): void
    {
        Log::info('test_Event TestListener' );
    }
}
