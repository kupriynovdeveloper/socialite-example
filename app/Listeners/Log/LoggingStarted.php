<?php

namespace App\Listeners\Log;

use App\Events\LogStartedEvent;
use Illuminate\Support\Facades\Log;

class LoggingStarted
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
    public function handle(LogStartedEvent $event): void
    {
        Log::info("Логирование началось для модели: {$event->model} (событие: {$event->event})");
    }
}
